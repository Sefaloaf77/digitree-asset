<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Assets;
use App\Models\ContentAssets;
use App\Models\ContentPlants;
use App\Models\IndexAssets;
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

        $id_asset = $request->id;
        $nama_asset = $request->nama_asset;
        $jenis = $request->jenis;
        $ulasan = [
            "id" => $id_asset,
            "nama_asset" => $nama_asset,
            "jenis" => $jenis,
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
            'code_asset' => 'required|numeric',
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
        //     'code_asset' => $request->code_asset
        // ]);
        Reviews::create($request->all());

        return redirect()->route('aset.show', $request->code_asset)->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $assetData = Assets::where('code_asset', $id)->first();
        $assetContent = ContentAssets::find($assetData->id_content_asset);
        $assetIndex = IndexAssets::find($assetData->id_index_asset);
        $reviewData = Reviews::where('code_asset', $id)->orderBy('created_at', 'desc')->limit(20)->get();
        $avgRating = Reviews::where('code_asset', $id)->avg('rating');
        $ads = Ads::first(); //ini nanti diubah sesuai relasi
        Carbon::setLocale('id'); // Mengatur bahasa ke bahasa Indonesia
        $tanggalBuka = Carbon::parse($assetData->date_open);
        $tanggalBuka = $tanggalBuka->translatedFormat('d F Y');

        $asset = [
            "id" => $assetData->id,
            "large" => $assetData->large ? $assetData->large : '-',
            "value" => $assetData->value ? $assetData->value : '-',
            "location" => $assetData->location ? $assetData->location : '-',
            "address" => $assetData->address ? $assetData->address : '-',
            "age" => $assetData->age ? $assetData->age : '-',
            "date_open" => $tanggalBuka ? $tanggalBuka : '-',
            "organizer" => $assetData->organizer ? $assetData->organizer : '-',
            "nama" => $assetIndex->nama ? $assetIndex->nama : '-',
            "nama_lokal" => $assetIndex->nama_lokal ? $assetIndex->nama_lokal : '-',
            "jenis_aset" => $assetIndex->jenis_aset ? $assetIndex->jenis_aset : '-',
            "history" => $assetContent->history ? $assetContent->history : '-',
            "video" => $assetContent->video ? $assetContent->video : '-',
            "image" => $assetContent->image ? $assetContent->image : '-',
            "benefit" => $assetContent->benefit ? $assetContent->benefit : '-',
            "fact" => $assetContent->fact ? $assetContent->fact : '-',
        ];
        $review = [];
        foreach ($reviewData as $key => $value) {
            // Tanggal yang ingin Anda konversi
            $dateReview = $value->created_at;

            // Membuat instance Carbon dari tanggal tersebut
            $carbonDate = Carbon::parse($dateReview);

            // Menghasilkan string waktu relatif
            $stringTime = $carbonDate->diffForHumans();
            $review[$key] = [
                'id' => $value->id,
                'name' => $value->name,
                'phone' => $value->phone,
                'rating' => $value->rating,
                'comment' => $value->comment,
                'created_at' => $stringTime,
            ];
        }
        // dd($reviewData);

        $mergeContentAsset = [
            'asset' => $asset,
            'ulasan' => $review,
            'avgRating' => $avgRating,
            'ads' => $ads,
        ];


        return view('frontend.view', ['asset' => $mergeContentAsset]);
    }

    public function location(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $assetData = Assets::where('id', $request->id)->first();
        $location = $request->latitude . ',' . $request->longitude;
        // dd($location);
        if (!Session::has('scanned')) {
            // Menyimpan data kunjungan
            RecordScans::create([
                'scan_date' => Carbon::now(),
                'code_asset' => $assetData->code_asset,
                'ip_address' => request()->ip(),
                'location' => $location
            ]);

            // Mengatur session 'scanned' untuk menandakan kunjungan telah tercatat
            Session::put('scanned', true);
        }
        return response()->json(['message' => 'Location has successfully!'], 200);

    }

}
