<?php

namespace App\Http\Controllers;

use App\Models\ContentPlants;
use App\Models\IndexPlants;
use App\Models\Plants;
use App\Models\RecordScans;
use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Storage;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Plants::find(1));
        // return view('frontend.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());

        $id_pohon = $request->id;
        $name_pohon = $request->name_pohon;
        $genus = $request->genus;
        $spesies = $request->spesies;
        $ulasan = [
            "id" => $id_pohon,
            "name_pohon" => $name_pohon,
            "genus" => $genus,
            "spesies" => $spesies,
        ];
        // dd($ulasan);
        return view('frontend.tambah-ulasan', ['ulasan' => $ulasan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'rating' => 'required|numeric',
            'comment' => 'required|min:3',
            'code_plant' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data gagal disimpan!');
        }
        // dd($request);
        // Reviews::create([
        //     'name' => $request->name,
        //     'phone' => $request->phone,
        //     'rating' => $request->rating,
        //     'comment' => $request->comment,
        //     'code_plant' => $request->code_plant
        // ]);
        Reviews::create($request->all());

        return redirect()->route('plant.show', $request->code_plant)->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plantData = Plants::where('code_plant', $id)->first();
        $plantContent = ContentPlants::find($plantData->id_content_plants);
        $plantIndex = IndexPlants::find($plantData->id_index_plants);
        $reviewData = Reviews::where('code_plant', $id)->orderBy('created_at', 'desc')->limit(20)->get();
        $avgRating = Reviews::where('code_plant', $id)->avg('rating');

        Carbon::setLocale('id'); // Mengatur bahasa ke bahasa Indonesia
        $tanggalTanam = Carbon::parse($plantData->date_plant);
        $tanggalTanam = $tanggalTanam->translatedFormat('d F Y');

        if (!Session::has('scanned')) {
            // Menyimpan data kunjungan
            RecordScans::create([
                'scan_date' => Carbon::now(),
                'code_plant' => $id,
                'ip_address' => request()->ip(),
            ]);

            // Mengatur session 'scanned' untuk menandakan kunjungan telah tercatat
            Session::put('scanned', true);
        }
        // $currentDate = Carbon::now();
        // $agePlantNow = $tanggalTanam->diffInDays($currentDate);
        // $currentDate = Carbon::now();

        // // Pastikan tanggal tanam valid sebelum menghitung usia
        // if ($tanggalTanam && $tanggalTanam->lessThanOrEqualTo($currentDate)) {
        //     $agePlantNow = $tanggalTanam->diffInYears($currentDate);
        // } else {
        //     $agePlantNow = 0; // atau handle sesuai kebutuhan Anda
        // }

        $plant = [
            "id" => $plantData->id,
            "tall" => $plantData->tall ? $plantData->tall : '-',
            "round" => $plantData->round ? $plantData->round : '-',
            "location" => $plantData->location ? $plantData->location : '-',
            "age" => $plantData->age ? $plantData->age : '-',
            "date_plant" => $tanggalTanam ? $tanggalTanam : '-',
            "source_fund" => $plantData->source_fund ? $plantData->source_fund : '-',
            "name" => 'Pohon ' . $plantIndex->name ? $plantIndex->name : '-',
            "genus" => $plantIndex->genus ? $plantIndex->genus : '-',
            "species" => $plantIndex->species ? $plantIndex->species : '-',
            "ordo" => $plantIndex->ordo ? $plantIndex->ordo : '-',
            "kingdom" => $plantIndex->kingdom ? $plantIndex->kingdom : '-',
            "famili" => $plantIndex->famili ? $plantIndex->famili : '-',
            "kelas" => $plantIndex->kelas ? $plantIndex->kelas : '-',
            "divisi" => $plantIndex->divisi ? $plantIndex->divisi : '-',
            "history" => $plantContent->history ? $plantContent->history : '-',
            "videos" => $plantContent->videos ? $plantContent->videos : '-',
            "image" => $plantContent->image ? $plantContent->image : '-',
            "morfologi" => $plantContent->morfologi ? $plantContent->morfologi : '-',
            "benefit" => $plantContent->benefit ? $plantContent->benefit : '-',
            "fact" => $plantContent->fact ? $plantContent->fact : '-',
        ];

        foreach ($reviewData as $key => $value) {
            // Tanggal yang ingin Anda konversi
            $dateReview = $value->created_at;

            // Membuat instance Carbon dari tanggal tersebut
            $carbonDate = Carbon::parse($dateReview);

            // Menghasilkan string waktu relatif
            $stringTime = $carbonDate->diffForHumans();
            $reviewData[$key] = [
                'id' => $value->id,
                'name' => $value->name,
                'phone' => $value->phone,
                'rating' => $value->rating,
                'comment' => $value->comment,
                'created_at' => $stringTime,
            ];
        }
        // dd($reviewData);

        $mergeContentPlant = [
            'plant' => $plant,
            'ulasan' => $reviewData,
            'avgRating' => $avgRating,
        ];

        // Menambahkan URL gambar ke response
        // return response()->json([
        //     'plant' => $plant,
        //     'image_url' => $imageUrl
        // ]);

        // dd($mergeContentPlant);

        return view('frontend.view', ['plant' => $mergeContentPlant]);
    }

    // public function ulasan(Request $request)
    // {

    //     //validate form
    //     $request->validate([
    //         'name' => 'required|min:5',
    //         'phone' => 'required|min:12',
    //         'rating' => 'required|numeric',
    //         'coment' => 'required|min:5'
    //     ]);

    //     dd($request);

    //     Reviews::create([
    //         'name' => $request->name,
    //         'phone' => $request->phone,
    //         'rating' => $request->rating,
    //         'comment' => $request->coment

    //     ]);

    //     return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(frontend $frontend)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, frontend $frontend)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(frontend $frontend)
    // {
    //     //
    // }
}
