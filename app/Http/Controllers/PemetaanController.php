<?php

namespace App\Http\Controllers;

use App\Models\IndexPlants;
use App\Models\Pemetaan;
use App\Models\Plants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PemetaanController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('superadmin');

        // Fetch distinct values for dropdown filters
        $ages = Plants::distinct()->pluck('age')->sort()->values();
        $addresses = Plants::distinct()->pluck('address')->sort()->values();
        $names = IndexPlants::distinct()->pluck('name')->sort()->values();
        $species = IndexPlants::distinct()->pluck('species')->sort()->values();
        $codePlants = Plants::distinct()->pluck('code_plant')->sort()->values();  // Fetch distinct code_plant

        $query = Plants::with('indexPlant', 'contentPlant', 'villages');

        // Apply filters based on request parameters
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('address', 'like', '%' . $search . '%')
                    ->orWhere('age', 'like', '%' . $search . '%')
                    ->orWhere('code_plant', 'like', '%' . $search . '%')
                    ->orWhereHas('indexPlant', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('species', 'like', '%' . $search . '%');
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
            $query->whereHas('indexPlant', function ($q) use ($request) {
                $q->where('name', $request->name);
            });
        }

        if ($request->has('species') && $request->species) {
            $query->whereHas('indexPlant', function ($q) use ($request) {
                $q->where('species', $request->species);
            });
        }

        if ($request->has('code_plant') && $request->code_plant) {
            $query->where('code_plant', $request->code_plant);
        }

        // Fetch filtered plants
        $plants = $query->get();

        return view('pemetaan.index', compact('plants', 'ages', 'addresses', 'names', 'species', 'codePlants'));
    }
}
