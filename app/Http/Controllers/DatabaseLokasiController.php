<?php

namespace App\Http\Controllers;

use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DatabaseLokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('superadmin');
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $per_page = $request->input('per_page', 10);

        $villages = Villages::where('name', 'like', "%{$request->search}%")
            ->orWhere('kecamatan', 'like', "%{$request->search}%")
            ->orWhere('kab_kota', 'like', "%{$request->search}%")
            ->orWhere('province', 'like', "%{$request->search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($per_page);

        return view('database-lokasi.index', [
            'villages' => $villages,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
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
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'kecamatan' => 'required|min:3',
            'kab_kota' => 'required|min:3',
            'province' => 'required|min:3',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data gagal disimpan!');
        }
        $data = [
            'name' => ucwords(strtolower($request->name)),
            'kecamatan' => ucwords(strtolower($request->kecamatan)),
            'kab_kota' => ucwords(strtolower($request->kab_kota)),
            'province' => ucwords(strtolower($request->province)),
        ];
        Villages::create($data);
        // Villages::create($request->all());
        return redirect()->route('dashboard.lokasi.index')->with('success', 'Data Berhasil Tersimpan!');
    }

    public function getDataLokasi()
    {
        $dataIndex = Villages::get();

        $dataIndexFilter = [];
        $no = 1;

        foreach ($dataIndex as $village) {
            $dataVillages = [
                'no' => $no++,
                'name' => $village['name'],
                'kecamatan' => $village['kecamatan'],
                'kab_kota' => $village['kab_kota'],
                'province' => $village['province'],
            ];
            $dataIndexFilter[] = $dataVillages;
        }

        // dd($dataVillages);
        return json_encode($dataIndexFilter);
    }

    /**
     * Display the specified resource.
     */
    public function show(Villages $databaseLokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Villages $villages, $id)
    {
        Gate::authorize('superadmin');
        $villages = Villages::findOrFail($id);
        // dd($villages);
        return view('database-lokasi.edit', ['lokasi' => $villages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Villages $villages, $id)
    {
        $villages = Villages::findOrFail($id);
        // dd($villages);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'kecamatan' => 'required|string|min:3',
            'kab_kota' => 'required|string|min:3',
            'province' => 'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data gagal disimpan!');
        }

        $data = [
            'name' => ucwords(strtolower($request->name)),
            'kecamatan' => ucwords(strtolower($request->kecamatan)),
            'kab_kota' => ucwords(strtolower($request->kab_kota)),
            'province' => ucwords(strtolower($request->province)),
        ];
        Villages::where('id', $id)
            ->update($data);
        return redirect()->route('dashboard.lokasi.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Villages $villages, $id)
    {
        // dd($id);
        Villages::destroy($id);
        // return redirect('/roles')->with('success', 'Data berhasil dihapus!');
        return response()->json(['status' => 'Data berhasil dihapus!']);
    }
}
