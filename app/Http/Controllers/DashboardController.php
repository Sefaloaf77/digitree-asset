<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Assets;
use App\Models\ContentAssets;
use App\Models\IndexAssets;
use App\Models\RecordScans;
use App\Models\Reviews;
use App\Models\Villages;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('superadmin');
        $totalPlant = Assets::count();
        $totalIndexPlant = IndexAssets::count();
        $totalScannedQR = RecordScans::count();
        $avgRating = round(Reviews::avg('rating'), 1);
        $summaryData = [
            'totalPlant' => $totalPlant ?: 0,
            'totalIndexPlant' => $totalIndexPlant ?: 0,
            'scannedQR' => $totalScannedQR ?: 0,
            'avgRating' => $avgRating ?: 0,
        ];

        // Get plants data directly
        $plants = $this->getPlantData();

        return view('dashboard.index', ['summary' => $summaryData, 'plants' => $plants]);
    }

    /**
     * Get plant data for dashboard
     */
    private function getPlantData()
    {
        $plants = Assets::with(['IndexAsset', 'ContentAsset'])->get();
        $no = 1;

        $result = $plants->map(function ($plant) use (&$no) {
            $indexPlant = $plant->IndexAsset;
            $contentPlant = $plant->ContentAsset;
            $reviews = Reviews::where('code_asset', $plant->code_asset)->get();
            $averageRating = $reviews->avg('rating');

            return [
                'no' => $no++,
                'id' => $plant->id ?? '-',
                'code_asset' => $plant->code_asset ?? '-',
                'large' => $plant->large ?? '-',
                'age' => $plant->age ?? '-',
                'value' => $plant->value ?? '-',
                'location' => $plant->location ?? '-',
                'date_open' => $plant->date_open ?? '-',
                'organizer' => $plant->organizer ?? '-',
                'address' => $plant->address ?? '-',
                'index_plant_data' => [
                    'id' => $indexPlant->id ?? '-',
                    'nama_lokal' => $indexPlant->nama_lokal ?? '-',
                    'jenis_aset' => $indexPlant->jenis_aset ?? '-',
                ],
                'content_plant_data' => [
                    'history' => $contentPlant->history ?? '-',
                ],
                'reviews' => $reviews->map(function ($review) {
                    return [
                        'name' => $review->name ?? '-',
                        'rating' => $review->rating ?? '-',
                        'comment' => $review->comment ?? '-',
                    ];
                }),
                'avg_rating' => $averageRating ? $averageRating : '0',
            ];
        });

        return $result->toArray();
    }

    public function perlokasi($id = null)
    {
        // Gate::authorize('superadmin');
        $desa = Villages::all();

        if ($id) {
            // Filter by specific location
            $asset = Assets::where('id_village', $id)->get();
            $codePlantsList = $asset->pluck('code_asset');
            $indexPlantsList = $asset->pluck('id_index_asset');

            $totalPlantbyVillages = $asset->count();
            $totalIndexPlantByCode = IndexAssets::whereIn('id', $indexPlantsList)->count();
            $totalRecordByCode = RecordScans::whereIn('code_asset', $codePlantsList)->count();
            $averageRatingByCode = round(Reviews::whereIn('code_asset', $codePlantsList)->avg('rating'), 1);

            $plants = $this->getPlantDataByLocation($id);
        } else {
            // Show all locations
            $totalPlantbyVillages = Assets::count();
            $totalIndexPlantByCode = IndexAssets::count();
            $totalRecordByCode = RecordScans::count();
            $averageRatingByCode = round(Reviews::avg('rating'), 1);

            $plants = $this->getPlantDataByLocation(null);
        }

        $summaryData = [
            'totalPlant' => $totalPlantbyVillages ?: 0,
            'totalIndexPlant' => $totalIndexPlantByCode ?: 0,
            'scannedQR' => $totalRecordByCode ?: 0,
            'avgRating' => $averageRatingByCode ?: 0,
        ];

        return view('dashboard.index-lokasi', ['summary' => $summaryData, 'desa' => $desa, 'plants' => $plants, 'selectedVillage' => $id]);
    }

    /**
     * Get plant data by location for dashboard perlokasi
     * If villageId is null, returns all plants
     */
    private function getPlantDataByLocation($villageId = null)
    {
        $query = Assets::with(['IndexAsset', 'ContentAsset']);

        if ($villageId) {
            $query->where('id_village', $villageId);
        }

        $plants = $query->get();
        $no = 1;

        $result = $plants->map(function ($plant) use (&$no) {
            $indexPlant = $plant->IndexAsset;
            $contentPlant = $plant->ContentAsset;
            $reviews = Reviews::where('code_asset', $plant->code_asset)->get();
            $averageRating = $reviews->avg('rating');

            return [
                'no' => $no++,
                'id' => $plant->id ?? '-',
                'code_plant' => $plant->code_asset ?? '-',
                'large' => $plant->large ?? '-',
                'age' => $plant->age ?? '-',
                'value' => $plant->value ?? '-',
                'location' => $plant->location ?? '-',
                'date_open' => $plant->date_open ?? '-',
                'organizer' => $plant->organizer ?? '-',
                'address' => $plant->address ?? '-',
                'index_plant_data' => [
                    'id' => $indexPlant->id ?? '-',
                    'name' => $indexPlant->nama_lokal ?? '-',
                    'jenis_aset' => $indexPlant->jenis_aset ?? '-',
                ],
                'content_plant_data' => [
                    'history' => $contentPlant->history ?? '-',
                ],
                'reviews' => $reviews->map(function ($review) {
                    return [
                        'name' => $review->name ?? '-',
                        'rating' => $review->rating ?? '-',
                        'comment' => $review->comment ?? '-',
                    ];
                }),
                'avg_rating' => $averageRating ? $averageRating : '0',
            ];
        });

        return $result->toArray();
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Dashboard $dashboard)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Dashboard $dashboard)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Dashboard $dashboard)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Dashboard $dashboard)
    // {
    //     //
    // }
}
