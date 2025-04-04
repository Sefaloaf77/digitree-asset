<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Villages;
use App\Models\IndexAssets;
use Illuminate\Http\Request;
use App\Models\ContentAssets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataPohonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('superadmin');
        $data = Assets::all();
        return view('database-pohon.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('superadmin');
        $jenisPohon = IndexAssets::all();
        $desa = Villages::all();
        return view('database-pohon.create', ['jenisPohon' => $jenisPohon, 'desa' => $desa]);
    }

    public function save(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'id_index_plants' => 'required',
                // 'id_content_plant' => 'nullable',
                'code_plant' => 'required',
                'age' => 'required',
                'tall' => 'required',
                'round' => 'required',
                'source_fund' => 'nullable',
                'id_villages' => 'required',
                'address' => 'required',
                'location' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Data gagal disimpan!');
            }
            // dd($request);

            $contentId = ContentAssets::where('id_index_plant', $request->id_index_plants)->value('id');
            // dd($contentId);
            Assets::create([
                'id_index_plants' => $request->id_index_plants,
                'id_content_plants' => $contentId,
                'code_plant' => $request->code_plant,
                'age' => $request->age,
                'tall' => $request->tall,
                'round' => $request->round,
                'source_fund' => ucwords(strtolower($request->source_fund)),
                'id_villages' => $request->id_villages,
                'address' => $request->address,
                'location' => $request->location,
            ]);
            // Villages::create($request->all());
            return redirect()->route('dashboard.index')->with('success', 'Data Berhasil Tersimpan!');
        } catch (\Exception $e) {
            // Tangani kesalahan umum lainnya
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Store Index and Content pohon
    public function store(Request $request)
    {
        try {
            $rules = [
                'file-uploadT' => 'required|image', // File validation
                'nama_lokal' => 'required|string|max:255',
                'jenis_asset' => 'required|string|max:255',
                'history' => 'nullable|string',
                'description' => 'nullable|string',
                'benefit' => 'nullable|string',
                'fact' => 'nullable|string',
                'link_youtube' => 'nullable|url', // Optional validation for URL
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data gagal disimpan');
            }

            $uploadedFile = $request->file('file-uploadT');
            $imageName = 'konten_asset_' . $request->nama_lokal . '.' . $uploadedFile->getClientOriginalExtension();
            $request->file('file-uploadT')->storeAs('public/images', $imageName);

            $dataIndex = [
                'nama_lokal' => $request->nama_lokal,
                'jenis_aset' => $request->jenis_asset,
            ];

            // Save data to Table 1 first
            $table_index = IndexAssets::create($dataIndex);
            $id_index = $table_index->id;

            // Memparse URL untuk mendapatkan komponen query-nya
            $parsed_url = parse_url($request->link_youtube);

            // Memparse query string untuk mendapatkan nilai dari 'v'
            parse_str($parsed_url['query'], $query_params);

            // Mendapatkan nilai dari 'v'
            $video_id = $query_params['v'];

            $dataContent = [
                'history' => $request->history,
                'description' => $request->description,
                'benefit' => $request->benefit,
                'fact' => $request->fact,
                'video' => $video_id,
                'image' => 'images/' . $imageName, // Store image path
                'id_index_asset' => $id_index,
            ];

            // Save data to Table 2 with the retrieved ID
            ContentAssets::create($dataContent);

            return redirect('dashboard/asset')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     //

    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(dataPohon $dataPohon)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_index_plants' => 'required',
            // 'id_content_plant' => 'nullable',
            'code_plant' => 'required',
            'age' => 'required',
            'tall' => 'required',
            'round' => 'required',
            'source_fund' => 'nullable',
            'id_villages' => 'required',
            'address' => 'required',
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data gagal disimpan!');
        }

        $data = [
            'id_index_plants' => $request->id_index_plants,
            'code_plant' => $request->code_plant,
            'age' => $request->age,
            'tall' => $request->tall,
            'round' => $request->round,
            'source_fund' => ucwords(strtolower($request->source_fund)),
            'id_villages' => $request->id_villages,
            'address' => $request->address,
            'location' => $request->location,
        ];
        Assets::where('code_plant', $request->code_plant)->update($data);
        return redirect()->route('dashboard.index')->with('success', 'Data Berhasil Tersimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request)
    // {
    //     //

    // }

    public function getDataIndexPohon()
    {
        $dataIndex = IndexAssets::get();

        $dataIndexFilter = [];
        $no = 1;

        foreach ($dataIndex as $indexPohon) {
            $dataIndexPohon = [
                'no' => $no++,
                'id' => $indexPohon->id,
                'name' => $indexPohon['name'],
                // 'latin_name' => $indexPohon['genus'] . " " . $indexPohon['species'],
                'latin_name' => $indexPohon['species'],
            ];
            $dataIndexFilter[] = $dataIndexPohon;
        }

        return json_encode($dataIndexFilter);
    }

    public function getDataContentPohon($id)
    {
        // dd($id);
        $dataIndex = IndexAssets::where('id', $id)->first();
        $id_data_index = $dataIndex->id; //id index plant for the fix content match with the index
        $dataContent = ContentAssets::where('id_index_plant', $id_data_index)->first();

        $dataAll = [
            'name' => $dataIndex->name ? $dataIndex->name : '-',
            'genus' => $dataIndex->genus ? $dataIndex->genus : '-',
            'spesies' => $dataIndex->species ? $dataIndex->species : '-',
            'ordo' => $dataIndex->ordo ? $dataIndex->ordo : '-',
            'divisi' => $dataIndex->divisi ? $dataIndex->divisi : '-',
            'kelas' => $dataIndex->kelas ? $dataIndex->kelas : '-',
            'famili' => $dataIndex->famili ? $dataIndex->famili : '-',
            'kingdom' => $dataIndex->kingdom ? $dataIndex->kingdom : '-',
            'history' => $dataContent->history ? $dataContent->history : '-',
            'morfologi' => $dataContent->morfologi ? $dataContent->morfologi : '-',
            'benefit' => $dataContent->benefit ? $dataContent->benefit : '-',
            'fact' => $dataContent->fact ? $dataContent->fact : '-',
            'image' => $dataContent->image ? $dataContent->image : '-',
            'videos' => $dataContent->videos ? 'https://www.youtube.com/watch?v=' . $dataContent->videos : '-',
        ];

        // dd( json_encode(asset($dataContent->image )) );

        return json_encode($dataAll);
    }

    public function updateContentIndexPohon(Request $request)
    {
        // dd($request);

        // dd($content_plant_specifict);
        $dataIndexSpecifict = [
            'name' => $request->name_asset,
            'kingdom' => $request->kingdom,
            'divisi' => $request->divisi,
            'species' => $request->spesies,
            'kelas' => $request->kelas,
            'ordo' => $request->ordo,
            'genus' => $request->genus,
            'famili' => $request->famili,
        ];

        $id_index_plant = $request->id_index;
        $content_plant_specifict = ContentAssets::where('id_index_plant', $id_index_plant)->firstOrFail();

        // Memparse URL untuk mendapatkan komponen query-nya
        $parsed_url = parse_url($request->link_youtube);

        // Memparse query string untuk mendapatkan nilai dari 'v'
        parse_str($parsed_url['query'], $query_params);

        // Mendapatkan nilai dari 'v'
        $video_id = $query_params['v'];

        $dataContentSpecifict = [
            'history' => $request->history,
            'morfologi' => $request->morfologi,
            'benefit' => $request->benefit,
            'fact' => $request->fact,
            'videos' => $video_id,
        ];

        // Cek apakah file input ada dan valid
        if ($request->hasFile('file-uploadE') && $request->file('file-uploadE')->isValid()) {
            // Handle file upload
            $uploadedFile = $request->file('file-uploadE');
            $imageName = 'konten_asset_' . $request->name_asset . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->storeAs('public/images', $imageName);
            $dataContentSpecifict['image'] = 'images/' . $imageName;
            // dd($dataContentSpecifict['image']);
        }
        // Update data pada IndexAssets
        $index_plant = IndexAssets::findOrFail($id_index_plant);
        $index_plant->update($dataIndexSpecifict);

        // Update data pada ContentAssets
        $content_plant_specifict->update($dataContentSpecifict);

        return redirect()->back()->with('success', 'Plant details updated successfully');

        // dd($dataContentSpecifict);

    }

    public function deleteContentIndexPohon(Request $request)
    {
        // dd($request);

        // $id_index_plant = $request->id_konten_delete;
        // $content_plant_specifict = ContentAssets::where('id_index_plant', $id_index_plant)->firstOrFail();
        // $content_plant_specifict->delete();

        // // Menghapus data dari tabel IndexAssets berdasarkan id_index
        // $index_plant = IndexAssets::where('id', $id_index_plant)->findOrFail($id_index_plant);
        // $index_plant->delete();

        // Find the record to be deleted using the provided ID
        // $plant = ContentAssets::findOrFail($id);

        // Delete the record from the database
        // $plant->delete();
        $id_index_plant = $request->id_konten_delete;
        DB::transaction(function () use ($id_index_plant) {
            // Menghapus data dari tabel ContentAssets berdasarkan id_index_plant
            $content_plant_specific = ContentAssets::where('id_index_plant', $id_index_plant)->firstOrFail();
            $content_plant_specific->delete();

            // Menghapus data dari tabel IndexAssets berdasarkan id_index_plant
            $index_plant = IndexAssets::findOrFail($id_index_plant);
            $index_plant->delete();
        });

        // Return a success response (e.g., JSON or redirect)
        return redirect()->back()->with('success', 'Index and Content Plant deleted successfully!');
    }

    public function generateQr($id)
    {
        // $qr = new Generator;
        // $qrCode = QrCode::size(256)->generate('http://127.0.0.1:8000/plant/' . $id);
        // // Save the QR code as an image
        // $fileName = 'qrcode_' . $id . '.png';
        // $filePath = 'public/qrcodes/' . $fileName;
        // Storage::put($filePath, base64_decode(substr($qrCode, strpos($qrCode, ',') + 1)));

        // // Get the URL for downloading the QR code
        // $downloadUrl = Storage::url($filePath);

        // return view('database-pohon.qr', ['qr_code' => $qrCode, 'download_url' => $downloadUrl]);
        // return view('database-pohon.qr', ['qr_code' => $qrCode]);
        // return response()->json(['qr_code' => base64_encode($qrCode)], 200);

        // Mengambil data dari tabel plant berdasarkan id
        $plant = Assets::where('code_plant', $id)->first();
        // dd($plant);

        if ($plant) {
            // Mengambil data dari tabel index_plants berdasarkan id_index_plants
            $indexPlant = IndexAssets::find($plant->id_index_plants);

            if ($indexPlant) {
                return response()->json([
                    'name' => $indexPlant->name,
                    'code_plant' => $plant->code_plant,
                ]);
            } else {
                return response()->json([
                    'error' => 'Index plant not found',
                ], 404);
            }
        } else {
            return response()->json([
                'error' => 'Plant not found',
            ], 404);
        }
    }

}
