<?php

namespace App\Http\Controllers;

use App\Models\AccessVillages;
use App\Models\User;
use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class UserRolesController extends Controller
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

        $user = User::where('name', 'like', "%{$request->search}%")
            ->orWhere('role', 'like', "%{$request->search}%")
            ->orWhere('email', 'like', "%{$request->search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate($per_page);

        return view('user-role.index', [
            'user' => $user,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('superadmin');
        return view('user-role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => 'required',
                'role' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Data gagal disimpan!');
            }
            // dd($request);
            $user = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // event(new Registered($user));

            return redirect()->route('dashboard.user-role.index')->with('success', 'Data Berhasil Tersimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        try {
            Gate::authorize('superadmin');
            $villages = Villages::all();
            $user = User::findOrFail($id);
            $userVillage = DB::table('users')
                ->leftJoin('access_villages', 'users.id', '=', 'access_villages.id_user')
                ->leftJoin('villages', 'access_villages.id_village', '=', 'villages.id')
                ->select(
                    'users.id', // Select specific fields instead of `users.*`
                    'users.name',
                    'users.email',
                    'access_villages.id_village',
                    'villages.name as village_name',
                    'villages.kecamatan',
                    'villages.kab_kota',
                    'villages.province'
                )
                ->whereNull('access_villages.deleted_at')
                ->where('users.id', $id)
                ->groupBy('users.id', 'access_villages.id_village', 'villages.id', 'villages.name', 'villages.kecamatan', 'villages.kab_kota', 'villages.province') // Include all fields in the GROUP BY clause
                ->orderBy('users.id')
                ->get();

            return view('user-role.edit', [
                'user' => $user,
                'villages' => $villages,
                'userVillage' => $userVillage
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => 'nullable',
                'role' => 'required',
                'id_village' => 'nullable|array', // Treat as an array
                'id_village.*' => 'exists:villages,id' // Ensure each item exists in the villages table
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Data gagal disimpan!');
            }

            // dd($request);
            User::where('id', $id)
                ->update([
                    'name' => $request->name ?? $user->name,
                    'role' => $request->role ?? $user->role,
                    'email' => $request->email ?? $user->email,
                    'password' => (Hash::make($request->password) ?? $user->password),
                ]);
            // Remove old AccessVillages entries for this user
            AccessVillages::where('id_user', $id)->delete();

            // Add new AccessVillages entries
            if ($request->has('id_village') && is_array($request->id_village)) {
                foreach ($request->id_village as $villageId) {
                    AccessVillages::create([
                        'id_user' => $id,
                        'id_village' => $villageId,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('dashboard.user-role.index')->with('success', 'Data Berhasil Tersimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
