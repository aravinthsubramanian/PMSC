<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:ROLE_READ'], ['only' => ['index', 'show', 'fetch']]);
        $this->middleware(['permission:ROLE_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:ROLE_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:ROLE_DELETE'], ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function fetch(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        // get data from products table
        $query = DB::table('roles')->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'like', "%" . $search . "%");
        });

        $orderByName = 'name';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'name';
                break;
            case '2':
                $orderByName = 'guard';
                break;
            case '3':
                $orderByName = 'created_at';
                break;
            case '4':
                $orderByName = 'updated_at';
                break;
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $roles = $query->skip($skip)->take($pageLength)->get();
        // dd($permissions);

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $roles], 200);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = Role::orderBy('name')->get();
        // return view('role.view',compact('roles'));
        return view('role.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $permission=[];
        foreach ($request->input('permission') as $k => $v) {
            $permission[$v]=intval($v);
        }

        $role = Role::create(['guard_name' => 'admin','name' => $request->input('role')]);
        $role->syncPermissions($permission);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('role');
        $role->update();

        $permission=[];
        foreach ($request->input('permission') as $k => $v) {
            $permission[$v]=intval($v);
        }

        $role->syncPermissions($permission);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table("roles")->where('id', $id)->delete();
        
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
