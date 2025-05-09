<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Assets;
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
        // dd($summaryData);
        return view('dashboard.index', ['summary' => $summaryData]);
    }

    public function perlokasi($id)
    {
        // Gate::authorize('superadmin');
        // Ambil data plant berdasarkan code_plant
        $asset = Assets::where('id_village', $id)->get();
        // Ambil list code_plant dari plants
        $codePlantsList = $asset->pluck('code_asset');
        $indexPlantsList = $asset->pluck('id_index_asset');

        // Hitung total plants berdasarkan id_villages
        $totalPlantbyVillages = $asset->count();
        // Hitung total index plant berdasarkan code_plant yang terkait
        $totalIndexPlantByCode = IndexAssets::whereIn('id', $indexPlantsList)->count();
        // Hitung total reviews berdasarkan code_plant yang terkait
        $totalRecordByCode = RecordScans::whereIn('code_asset', $codePlantsList)->count();
        // Hitung rata-rata rating berdasarkan code_plant yang terkait
        $averageRatingByCode = round(Reviews::whereIn('code_asset', $codePlantsList)->avg('rating'), 1);
        $desa = Villages::all();
        $summaryData = [
            'totalPlant' => $totalPlantbyVillages ?: 0,
            'totalIndexPlant' => $totalIndexPlantByCode ?: 0,
            'scannedQR' => $totalRecordByCode ?: 0,
            'avgRating' => $averageRatingByCode ?: 0,
        ];
        return view('dashboard.index-lokasi', ['summary' => $summaryData, 'desa' => $desa]);
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
