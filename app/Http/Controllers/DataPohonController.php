<?php

namespace App\Http\Controllers;

use App\Models\Plants;
use App\Models\Villages;
use App\Models\IndexPlants;
use Illuminate\Http\Request;
use App\Models\ContentPlants;
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
        $data = Plants::all();

        return view('database-pohon.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('superadmin');
        $jenisPohon = IndexPlants::all();
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

            $contentId = ContentPlants::where('id_index_plant', $request->id_index_plants)->value('id');
            // dd($contentId);
            Plants::create([
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
        // dd($request);
        $rules = [
            'file-uploadT' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg', // File validation
            'name_pohon' => 'required|string|max:255',
            'kingdom' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'spesies' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'ordo' => 'required|string|max:255',
            'genus' => 'required|string|max:255',
            'history' => 'nullable|string',
            'morfologi' => 'nullable|string',
            'benefit' => 'nullable|string',
            'fact' => 'nullable|string',
            'link_youtube' => 'nullable|url', // Optional validation for URL
        ];

        $uploadedFile = $request->file('file-uploadT');
        $imageName = 'konten_pohon_' . $request->name_pohon . '.' . $uploadedFile->getClientOriginalExtension();
        $request->file('file-uploadT')->storeAs('public/images', $imageName);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Data gagal disimpan');
        }

        $dataIndex = [
            'name' => $request->name_pohon,
            'kingdom' => $request->kingdom,
            'divisi' => $request->divisi,
            'species' => $request->spesies,
            'kelas' => $request->kelas,
            'ordo' => $request->ordo,
            'genus' => $request->genus,
            'famili' => $request->famili,
        ];

        // Save data to Table 1 first
        $table_index = IndexPlants::create($dataIndex);
        $id_index = $table_index->id;

        // Memparse URL untuk mendapatkan komponen query-nya
        $parsed_url = parse_url($request->link_youtube);

        // Memparse query string untuk mendapatkan nilai dari 'v'
        parse_str($parsed_url['query'], $query_params);

        // Mendapatkan nilai dari 'v'
        $video_id = $query_params['v'];

        $dataContent = [
            'history' => $request->history,
            'morfologi' => $request->morfologi,
            'benefit' => $request->benefit,
            'fact' => $request->fact,
            'videos' => $video_id,
            'image' => 'images/' . $imageName, // Store image path
            'id_index_plant' => $id_index,
        ];

        // Save data to Table 2 with the retrieved ID
        ContentPlants::create($dataContent);

        // dd($tb_Content_Plant);

        return redirect('dashboard/pohon')->with('success', 'Data berhasil disimpan');
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
        Plants::where('code_plant', $request->code_plant)->update($data);
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
        $dataIndex = IndexPlants::get();

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
        $dataIndex = IndexPlants::where('id', $id)->first();
        $id_data_index = $dataIndex->id; //id index plant for the fix content match with the index
        $dataContent = ContentPlants::where('id_index_plant', $id_data_index)->first();

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
            'name' => $request->name_pohon,
            'kingdom' => $request->kingdom,
            'divisi' => $request->divisi,
            'species' => $request->spesies,
            'kelas' => $request->kelas,
            'ordo' => $request->ordo,
            'genus' => $request->genus,
            'famili' => $request->famili,
        ];

        $id_index_plant = $request->id_index;
        $content_plant_specifict = ContentPlants::where('id_index_plant', $id_index_plant)->firstOrFail();

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
            $imageName = 'konten_pohon_' . $request->name_pohon . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->storeAs('public/images', $imageName);
            $dataContentSpecifict['image'] = 'images/' . $imageName;
            // dd($dataContentSpecifict['image']);
        }
        // Update data pada IndexPlants
        $index_plant = IndexPlants::findOrFail($id_index_plant);
        $index_plant->update($dataIndexSpecifict);

        // Update data pada ContentPlants
        $content_plant_specifict->update($dataContentSpecifict);

        return redirect()->back()->with('success', 'Plant details updated successfully');

        // dd($dataContentSpecifict);

    }

    public function deleteContentIndexPohon(Request $request)
    {
        // dd($request);

        // $id_index_plant = $request->id_konten_delete;
        // $content_plant_specifict = ContentPlants::where('id_index_plant', $id_index_plant)->firstOrFail();
        // $content_plant_specifict->delete();

        // // Menghapus data dari tabel IndexPlants berdasarkan id_index
        // $index_plant = IndexPlants::where('id', $id_index_plant)->findOrFail($id_index_plant);
        // $index_plant->delete();

        // Find the record to be deleted using the provided ID
        // $plant = ContentPlants::findOrFail($id);

        // Delete the record from the database
        // $plant->delete();
        $id_index_plant = $request->id_konten_delete;
        DB::transaction(function () use ($id_index_plant) {
            // Menghapus data dari tabel ContentPlants berdasarkan id_index_plant
            $content_plant_specific = ContentPlants::where('id_index_plant', $id_index_plant)->firstOrFail();
            $content_plant_specific->delete();

            // Menghapus data dari tabel IndexPlants berdasarkan id_index_plant
            $index_plant = IndexPlants::findOrFail($id_index_plant);
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
        $plant = Plants::where('code_plant', $id)->first();
        // dd($plant);

        if ($plant) {
            // Mengambil data dari tabel index_plants berdasarkan id_index_plants
            $indexPlant = IndexPlants::find($plant->id_index_plants);

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
