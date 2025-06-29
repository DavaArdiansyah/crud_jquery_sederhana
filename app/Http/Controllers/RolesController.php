<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengaturan.roles.index');
    }

    public function datatables()
    {
        $query = Role::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($role) {
                return '
                    <button class="btn btn-sm btn-primary btn-sm btn-edit" data-id="' . $role->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger btn-sm btn-delete" data-id="' . $role->id . '">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $request->validate(['role_name' => 'required|string|max:255']);
        Role::create($request->only('role_name'));

        return response()->json(['message' => 'Role berhasil ditambahkan']);
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
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['role_name' => 'required|string|max:255']);
        $role = Role::findOrFail($id);
        $role->update($request->only('role_name'));

        return response()->json(['message' => 'Role berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message' => 'Role berhasil dihapus']);
    }
}
