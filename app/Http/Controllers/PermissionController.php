<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:PERMISSION_READ'], ['only' => ['index', 'show', 'fetch']]);
        $this->middleware(['permission:PERMISSION_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:PERMISSION_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:PERMISSION_DELETE'], ['only' => ['destroy']]);
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
        $query = DB::table('permissions')->select('*');

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
        $permissions = $query->skip($skip)->take($pageLength)->get();
        // dd($permissions);

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $permissions], 200);
        // return response()->json(['data' => $permissions], 200);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $permissions = Permission::orderBy('name')->get();
        // return view('permission.view',compact('permissions'));
        return view('permission.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|unique:permissions,name',
        ]);
        Permission::create(['guard_name' => 'admin','name' => $request->permission]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permission' => 'required',
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->permission;
        $permission->update();

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        DB::table("permissions")->where('id', $id)->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}
