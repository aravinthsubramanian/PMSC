<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:MAINCATEGORY_READ'], ['only' => ['index', 'show', 'fetch']]);
        $this->middleware(['permission:MAINCATEGORY_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:MAINCATEGORY_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:MAINCATEGORY_DELETE'], ['only' => ['destroy']]);
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
        $query = DB::table('main_categories')->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('category', 'like', "%" . $search . "%");
            $query->orWhere('category_status', 'like', "%" . $search . "%");
        });

        $orderByName = 'category';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'category';
                break;
            case '2':
                $orderByName = 'category_status';
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
        $categories = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $categories], 200);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = MainCategory::all();
        // return view('category.view', compact('categories'));

        return view('category.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:main_categories,category',
            'status' => 'required',
        ]);
        $category = new MainCategory();
        $category->category = $request->category;
        $category->category_status = $request->status;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
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
        $category = MainCategory::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
            'status' => 'required',
        ]);
        $category = MainCategory::find($id);
        $category->category = $request->category;
        $category->category_status = $request->status;
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = MainCategory::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
