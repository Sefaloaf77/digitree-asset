<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\ContentAssets;
use App\Models\IndexAssets;
use App\Models\RecordScans;
use App\Models\Reviews;
use App\Models\Villages;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    //
    public function getDataPlant()
    {
        $plants = Assets::all();
        $no = 1;

        foreach ($plants as $plant) {

            $result = $plants->map(function ($plant) use (&$no) {
                // Ambil data IndexPlant berdasarkan id_index_plant
                $indexPlant = IndexAssets::find($plant->id_index_asset);
                // Ambil data ContentPlant berdasarkan id_content_plants
                $contentPlant = ContentAssets::find($plant->id_content_asset);
                // Ambil data Review berdasarkan code_plant
                $reviews = Reviews::where('code_asset', $plant->code_asset)->get();
                // Hitung rata-rata rating
                $averageRating = $reviews->avg('rating');

                return [
                    'no' => $no++,
                    'id' => $plant->id ? $plant->id : '-',
                    'code_asset' => $plant->code_asset ? $plant->code_asset : '-',
                    'large' => $plant->large ? $plant->large : '-',
                    'age' => $plant->age ? $plant->age : '-',
                    'value' => $plant->value ? $plant->value : '-',
                    'location' => $plant->location ? $plant->location : '-',
                    'date_open' => $plant->date_open ? $plant->date_open : '-',
                    'organizer' => $plant->organizer ? $plant->organizer : '-',
                    'address' => $plant->address ? $plant->address : '-',
                    'index_plant_data' => [
                        'id' => $indexPlant->id ? $indexPlant->id : '-',
                        'nama_lokal' => $indexPlant->nama_lokal ? $indexPlant->nama_lokal : '-',
                        'jenis_aset' => $indexPlant->jenis_aset ? $indexPlant->jenis_aset : '-',
                    ],
                    'content_plant_data' => [
                        'history' => $contentPlant->history ? $contentPlant->history : '-',
                    ],
                    'reviews' => $reviews->map(function ($review) {
                        return [
                            'name' => $review->name ? $review->name : '-',
                            'rating' => $review->rating ? $review->rating : '-',
                            'comment' => $review->comment ? $review->comment : '-',
                        ];
                    }),
                    'avg_rating' => $averageRating ? $averageRating : '0',
                ];
            });
        }

        // dd($plants);
        return response()->json($result);
    }

    public function getDataPlantLocation($id)
    {
        // Ambil data plant berdasarkan code_plant
        $plants = Assets::where('id_villages', $id)->get();

        // Cek apakah data ditemukan
        if ($plants->isEmpty()) {
            return response()->json(['message' => 'Plants not found'], 404);
        }

        // // Ambil list code_plant dari plants
        // $codePlantsList = $plants->pluck('code_plant');
        // $indexPlantsList = $plants->pluck('id_index_plant');

        // // Hitung total plants berdasarkan id_villages
        // $totalPlantbyVillages = $plants->count();
        // // Hitung total index plant berdasarkan code_plant yang terkait
        // $totalIndexPlantByCode = IndexPlants::whereIn('id', $indexPlantsList)->count();
        // // Hitung total reviews berdasarkan code_plant yang terkait
        // $totalReviewByCode = RecordScans::whereIn('code_plant', $codePlantsList)->count();
        // // Hitung rata-rata rating berdasarkan code_plant yang terkait
        // $averageRatingByCode = round(Reviews::whereIn('code_plant', $codePlantsList)->avg('rating'), 1);

        $results = $plants->map(function ($plant) {

            // Ambil data IndexPlant berdasarkan id_index_plant
            $indexPlant = IndexAssets::find($plant->id_index_plant);
            // Ambil data ContentPlant berdasarkan id_content_plants
            $contentPlant = ContentAssets::find($plant->id_content_plants);
            // Ambil data Review berdasarkan code_plant
            $reviews = Reviews::where('code_plant', $plant->code_plant)->get();
            // Hitung rata-rata rating
            $averageRating = round($reviews->avg('rating'), 1);

            // Hitung jumlah terkait
            $relatedIndexPlantCount = IndexAssets::where('id', $plant->id_index_plant)->count();
            $relatedContentPlantCount = ContentAssets::where('id', $plant->id_content_plants)->count();
            $relatedReviewsCount = $reviews->count();
            $relatedQRScanCount = RecordScans::where('code_plant', $plant->code_plant)->count();

            return [
                'id' => $plant->id ?? '-',
                'code_plant' => $plant->code_plant ?? '-',
                'tall' => $plant->tall ?? '-',
                'age' => $plant->age ?? '-',
                'round' => $plant->round ?? '-',
                'location' => $plant->location ?? '-',
                'date_plant' => $plant->date_plant ?? '-',
                'source_fund' => $plant->source_fund ?? '-',
                'qr_code' => $plant->qr_code ?? '-',
                'address' => $plant->address ?? '-',
                'index_plant_data' => $indexPlant ? [
                    'id' => $indexPlant->id ?? '-',
                    'name' => $indexPlant->name ?? '-',
                    'genus' => $indexPlant->genus ?? '-',
                ] : null,
                'content_plant_data' => $contentPlant ? [
                    'history' => $contentPlant->history ?? '-',
                ] : null,
                'reviews' => $reviews->map(function ($review) {
                    return [
                        'name' => $review->name ?? '-',
                        'rating' => $review->rating ?? '-',
                        'comment' => $review->comment ?? '-',
                    ];
                }),
                'related_reviews_count' => $relatedReviewsCount,
                'related_index_count' => $relatedIndexPlantCount,
                'related_content_count' => $relatedContentPlantCount,
                'related_qr_scan_count' => $relatedQRScanCount,
                'avg_rating' => $averageRating ?? '-',
            ];
        });

        return response()->json($results);
    }

    public function deletePlant(Request $request)
    {
        // dd($request);

        $code_asset = $request->id_plant_delete;
        $plant_specifict = Assets::where('code_asset', $code_asset)->firstOrFail();
        $plant_specifict->delete();

        // Find the record to be deleted using the provided ID
        // $plant = ContentPlants::findOrFail($id);

        // Delete the record from the database
        // $plant->delete();

        // Return a success response (e.g., JSON or redirect)
        return redirect()->back()->with('success', 'Asset deleted successfully!');
    }

    public function updatePlant($id)
    {
        $assetData = Assets::where('code_asset', $id)->firstOrFail();
        $jenisAsset = IndexAssets::all();
        $desa = Villages::all();
        // $desaData = Villages::where('id', $assetData->id_villages)->firstOrFail();
        // $indexData = IndexPlants::where('id', $assetData->id_index_plant)->firstOrFail();
        // dd($jenisAsset);
        // $data = [
        //     'id_index_plant' => $assetData->id_index_plant,
        //     // 'id_content_plants' => $contentId,
        //     'code_plant' => $assetData->code_plant,
        //     'age' => $assetData->age,
        //     'tall' => $assetData->tall,
        //     'round' => $assetData->round,
        //     'source_fund' => ucwords(strtolower($assetData->source_fund)),
        //     'id_villages' => $desaData->id_villages,
        //     'address' => $request->address,
        //     'location' => $request->location,
        // ];

        $data = [
            'assetData' => $assetData,
            'jenisAsset' => $jenisAsset,
            'desa' => $desa,
        ];
        return view('database-pohon.edit', ['data' => $data, 'assetData' => $assetData, 'jenisAsset' => $jenisAsset, 'desa' => $desa]);


    }
}
