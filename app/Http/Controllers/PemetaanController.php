<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\IndexAssets;
use App\Models\Pemetaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PemetaanController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('superadmin');

        // Fetch distinct values for dropdown filters
        $ages = Assets::distinct()->pluck('age')->sort()->values();
        $addresses = Assets::distinct()->pluck('address')->sort()->values();
        $names = IndexAssets::distinct()->pluck('nama')->sort()->values();
        // $species = IndexAssets::distinct()->pluck('species')->sort()->values();
        $codeAssets = Assets::distinct()->pluck('code_asset')->sort()->values();  // Fetch distinct code_asset

        $query = Assets::with('indexAsset', 'contentAsset', 'villages');

        // Apply filters based on request parameters
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('address', 'like', '%' . $search . '%')
                    ->orWhere('age', 'like', '%' . $search . '%')
                    ->orWhere('code_asset', 'like', '%' . $search . '%')
                    ->orWhereHas('indexAsset', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->has('address') && $request->address) {
            $query->where('address', $request->address);
        }

        if ($request->has('age') && $request->age) {
            $age = $request->age;
            switch ($age) {
                case '< 1 tahun':
                    $query->where('age', '<', 1);
                    break;
                case '1-5 tahun':
                    $query->whereBetween('age', [1, 5]);
                    break;
                case '6-20 tahun':
                    $query->whereBetween('age', [6, 20]);
                    break;
                case '21-50 tahun':
                    $query->whereBetween('age', [21, 50]);
                    break;
                case '> 50 tahun':
                    $query->where('age', '>', 50);
                    break;
            }
        }

        if ($request->has('name') && $request->name) {
            $query->whereHas('indexAsset', function ($q) use ($request) {
                $q->where('nama', $request->name);
            });
        }

        // if ($request->has('species') && $request->species) {
        //     $query->whereHas('indexPlant', function ($q) use ($request) {
        //         $q->where('species', $request->species);
        //     });
        // }

        if ($request->has('code_asset') && $request->code_asset) {
            $query->where('code_asset', $request->code_asset);
        }

        // Fetch filtered assets
        $assets = $query->get();

        return view('pemetaan.index', compact('assets', 'ages', 'addresses', 'names', 'codeAssets'));
    }
    public function embed(Request $request)
    {
        // Gate::authorize('superadmin');
        // Fetch distinct values for dropdown filters
        $ages = Assets::distinct()->pluck('age')->sort()->values();
        $addresses = Assets::distinct()->pluck('address')->sort()->values();
        $names = IndexAssets::distinct()->pluck('nama')->sort()->values();
        // $species = IndexAssets::distinct()->pluck('species')->sort()->values();
        $codeAssets = Assets::distinct()->pluck('code_asset')->sort()->values();  // Fetch distinct code_asset

        $query = Assets::with('indexAsset', 'contentAsset', 'villages');
        $assets = $query->get();

        return view('pemetaan.embed', compact('assets', 'ages', 'addresses', 'names', 'codeAssets'));
    }
}
