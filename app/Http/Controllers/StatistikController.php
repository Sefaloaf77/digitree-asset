<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\RecordScans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class StatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('superadmin');
        // if (!Gate::allows('superadmin')) {
        //     abort(403);
        // }
        $sortBy = $request->input('sort_by', 'rs_id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $per_page = $request->input('per_page', 10);

        $statistik = DB::table('record_scans as rs')
            ->join('assets as p', 'rs.code_asset', '=', 'p.code_asset')
            ->join('index_assets as ip', 'p.id_index_asset', '=', 'ip.id')
            ->select('rs.id as rs_id', 'rs.ip_address', 'rs.scan_date', 'rs.code_asset', 'rs.location', 'p.id_index_asset', 'p.id_content_plant', 'p.address', 'ip.nama')
            ->where('ip.nama', 'like', "%{$request->search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($per_page);
        // dd($statistik);
        return view('statistik-pohon.visitor', [
            'visitor' => $statistik,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
    }
    public function reviewer(Request $request)
    {
        Gate::authorize('superadmin');
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $per_page = $request->input('per_page', 10);

        $reviewer = Reviews::where('name', 'like', "%{$request->search}%")
            ->orWhere('phone', 'like', "%{$request->search}%")
            ->orWhere('comment', 'like', "%{$request->search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($per_page);
        // dd($reviewer);
        return view('statistik-pohon.reviewer', [
            'reviewer' => $reviewer,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
    }

    public function detailReviewer($id)
    {
        $reviewer = Reviews::find($id);
        if ($reviewer) {
            return response()->json($reviewer);
        } else {
            return response()->json(['message' => 'Reviewer not found'], 404);
        }
    }

    public function getReviewPlant($id)
    {
        $reviews = Reviews::where('code_asset', $id)->get();
        // dd($reviews);
        if ($reviews) {
            return response()->json($reviews);
        } else {
            return response()->json(['message' => 'reviews not found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
