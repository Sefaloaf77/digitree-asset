<?php

namespace App\Http\Controllers;

use App\Models\ContentPlants;
use App\Models\IndexPlants;
use App\Models\Plants;
use App\Models\RecordScans;
use App\Models\Reviews;
use App\Models\Villages;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    //
    public function getDataPlant()
    {
        $plants = Plants::all();
        $no = 1;

        foreach ($plants as $plant) {

            $result = $plants->map(function ($plant) use (&$no) {
                // Ambil data IndexPlant berdasarkan id_index_plants
                $indexPlant = IndexPlants::find($plant->id_index_plants);
                // Ambil data ContentPlant berdasarkan id_content_plants
                $contentPlant = ContentPlants::find($plant->id_content_plants);
                // Ambil data Review berdasarkan code_plant
                $reviews = Reviews::where('code_plant', $plant->code_plant)->get();
                // Hitung rata-rata rating
                $averageRating = $reviews->avg('rating');

                return [
                    'no' => $no++,
                    'id' => $plant->id ? $plant->id : '-',
                    'code_plant' => $plant->code_plant ? $plant->code_plant : '-',
                    'tall' => $plant->tall ? $plant->tall : '-',
                    'age' => $plant->age ? $plant->age : '-',
                    'round' => $plant->round ? $plant->round : '-',
                    'location' => $plant->location ? $plant->location : '-',
                    'date_plant' => $plant->date_plant ? $plant->date_plant : '-',
                    'source_fund' => $plant->source_fund ? $plant->source_fund : '-',
                    'qr_code' => $plant->qr_code ? $plant->qr_code : '-',
                    'address' => $plant->address ? $plant->address : '-',
                    'index_plant_data' => [
                        'id' => $indexPlant->id ? $indexPlant->id : '-',
                        'name' => $indexPlant->name ? $indexPlant->name : '-',
                        'genus' => $indexPlant->genus ? $indexPlant->genus : '-',
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
                    'avg_rating' => $averageRating ? $averageRating : '-',
                ];
            });
        }

        // dd($plants);
        return response()->json($result);
    }

    public function getDataPlantLocation($id)
    {
        // Ambil data plant berdasarkan code_plant
        $plants = Plants::where('id_villages', $id)->get();

        // Cek apakah data ditemukan
        if ($plants->isEmpty()) {
            return response()->json(['message' => 'Plants not found'], 404);
        }

        // // Ambil list code_plant dari plants
        // $codePlantsList = $plants->pluck('code_plant');
        // $indexPlantsList = $plants->pluck('id_index_plants');

        // // Hitung total plants berdasarkan id_villages
        // $totalPlantbyVillages = $plants->count();
        // // Hitung total index plant berdasarkan code_plant yang terkait
        // $totalIndexPlantByCode = IndexPlants::whereIn('id', $indexPlantsList)->count();
        // // Hitung total reviews berdasarkan code_plant yang terkait
        // $totalReviewByCode = RecordScans::whereIn('code_plant', $codePlantsList)->count();
        // // Hitung rata-rata rating berdasarkan code_plant yang terkait
        // $averageRatingByCode = round(Reviews::whereIn('code_plant', $codePlantsList)->avg('rating'), 1);

        $results = $plants->map(function ($plant) {

            // Ambil data IndexPlant berdasarkan id_index_plants
            $indexPlant = IndexPlants::find($plant->id_index_plants);
            // Ambil data ContentPlant berdasarkan id_content_plants
            $contentPlant = ContentPlants::find($plant->id_content_plants);
            // Ambil data Review berdasarkan code_plant
            $reviews = Reviews::where('code_plant', $plant->code_plant)->get();
            // Hitung rata-rata rating
            $averageRating = round($reviews->avg('rating'), 1);

            // Hitung jumlah terkait
            $relatedIndexPlantCount = IndexPlants::where('id', $plant->id_index_plants)->count();
            $relatedContentPlantCount = ContentPlants::where('id', $plant->id_content_plants)->count();
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

        $code_plant = $request->id_plant_delete;
        $plant_specifict = Plants::where('code_plant', $code_plant)->firstOrFail();
        $plant_specifict->delete();

        // Find the record to be deleted using the provided ID
        // $plant = ContentPlants::findOrFail($id);

        // Delete the record from the database
        // $plant->delete();

        // Return a success response (e.g., JSON or redirect)
        return redirect()->back()->with('success', 'Plant deleted successfully!');
    }

    public function updatePlant($id)
    {
        $plantData = Plants::where('code_plant', $id)->firstOrFail();
        $jenisPohon = IndexPlants::all();
        $desa = Villages::all();
        // $desaData = Villages::where('id', $plantData->id_villages)->firstOrFail();
        // $indexData = IndexPlants::where('id', $plantData->id_index_plants)->firstOrFail();
        // dd($jenisPohon);
        // $data = [
        //     'id_index_plants' => $plantData->id_index_plants,
        //     // 'id_content_plants' => $contentId,
        //     'code_plant' => $plantData->code_plant,
        //     'age' => $plantData->age,
        //     'tall' => $plantData->tall,
        //     'round' => $plantData->round,
        //     'source_fund' => ucwords(strtolower($plantData->source_fund)),
        //     'id_villages' => $desaData->id_villages,
        //     'address' => $request->address,
        //     'location' => $request->location,
        // ];

        $data = [
            'plantData' => $plantData,
            'jenisPohon' => $jenisPohon,
            'desa' => $desa,
        ];
        // dd($data);
        return view('database-pohon.edit', $data);
    }
}
