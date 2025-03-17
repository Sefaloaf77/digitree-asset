<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Gate::authorize('superadmin');
        // $data = Ads::all();
        // return view('ads.index', ['data' => $data]);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $per_page = $request->input('per_page', 10);

        $ads = Ads::where('title', 'like', "%{$request->search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($per_page);
        return view('ads.index', [
            'ads' => $ads,
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
        $validator = Validator::make($request->all(), [
            'id' => 'nullable',
            'title' => 'required|min:3',
            'image' => 'required|image|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data gagal disimpan!');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalFileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');
            $fileName = 'iklan-' . $request->title . '_' . $timestamp . '.' . $fileExtension;
            $filePath = $request->file('image')->storeAs('images/iklan', $fileName, 'public');

            // $uploadedFile = $request->file('image');
            // $imageName = 'iklan-' . $request->title . '.' . $uploadedFile->getClientOriginalExtension();
            // $request->file('image')->storeAs('public/images', $imageName);
        } else {
            $fileName = null;
        }
        $data = [
            'title' => ucwords(strtolower($request->title)),
            'image' => $fileName
        ];
        // dd($data);
        Ads::create($data);
        // Villages::create($request->all());
        return redirect()->route('dashboard.ads.index')->with('success', 'Data Berhasil Tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ads $ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|min:3',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data gagal disimpan!');
        }
        $ads = Ads::findOrFail($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalFileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');
            $fileName = 'iklan-' . $request->title . '_' . $timestamp . '.' . $fileExtension;
            $filePath = $request->file('image')->storeAs('images/iklan', $fileName, 'public');

            // $uploadedFile = $request->file('image');
            // $imageName = 'iklan-' . $request->title . '.' . $uploadedFile->getClientOriginalExtension();
            // $request->file('image')->storeAs('public/images', $imageName);
        } else {
            $fileName = $ads->image;
        }
        $ads->title = $request->title;
        $ads->image = $fileName;
        // dd($ads);
        $ads->save();
        return redirect()->route('dashboard.ads.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $ads = Ads::where('id', $id)->firstOrFail();
        $ads->delete();
        return response()->json(['status' => 'Data berhasil dihapus!']);
        // return redirect()->route('dashboard.ads.index')->with('success', 'Data Berhasil Dihapus!');
        // return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
