<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:SUBCATEGORY_READ'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:SUBCATEGORY_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:SUBCATEGORY_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:SUBCATEGORY_DELETE'], ['only' => ['destroy']]);
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
        $query = DB::table('main_categories')->join('sub_categories', 'sub_categories.main_category_id', '=', 'main_categories.id')->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('category', 'like', "%" . $search . "%");
            $query->orWhere('subcategory', 'like', "%" . $search . "%");
            $query->orWhere('subcategory_status', 'like', "%" . $search . "%");
        });

        $orderByName = 'subcategory';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'category';
                break;
            case '2':
                $orderByName = 'subcategory';
                break;
            case '3':
                $orderByName = 'subcategory_status';
                break;
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $subcategories = $query->skip($skip)->take($pageLength)->get();
        // dd($permissions);

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $subcategories], 200);
        // return response()->json(['data' => $permissions], 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function getSubcategories($id)
    {
        $subcategories = Subcategory::where([['main_category_id', $id], ['subcategory_status', 'enable']])->get();
        // dd($subcategories);
        return response()->json($subcategories);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MainCategory::with('subcategories')->get();

        // dd(response()->json($categories));
        // return view('subcategory.view', compact('categories'));

        return view('subcategory.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MainCategory::where([['category_status', 'enable']])->get();
        return view('subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required|unique:sub_categories,subcategory',
            'status' => 'required',
        ]);
        $subcategory = new SubCategory();
        $subcategory->main_category_id = $request->category;
        $subcategory->subcategory = $request->subcategory;
        $subcategory->subcategory_status = $request->status;
        $subcategory->save();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully');
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
        $subcategory = SubCategory::find($id);
        $categories = MainCategory::where([['category_status', 'enable']])->get();
        return view('subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'status' => 'required',
        ]);
        $subcategory = SubCategory::find($id);
        $subcategory->main_category_id = $request->category;
        $subcategory->subcategory = $request->subcategory;
        $subcategory->subcategory_status = $request->status;
        $subcategory->update();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}
