<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:PRODUCT_READ'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:PRODUCT_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:PRODUCT_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:PRODUCT_DELETE'], ['only' => ['destroy']]);
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
        // $query = DB::table('products')->select('*');

        // $query = DB::table('products')
        //     ->join('main_categories', 'products.main_category_id', '=', 'main_categories.id')
        //     ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        //     ->select('*');

        $query = DB::table('main_categories')
        ->join('sub_categories', 'sub_categories.main_category_id', '=', 'main_categories.id')
        ->join('products', 'products.sub_category_id', '=', 'sub_categories.id')
        ->select('*');


        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('category', 'like', "%" . $search . "%");
            $query->orWhere('subcategory', 'like', "%" . $search . "%");
            $query->orWhere('product', 'like', "%" . $search . "%");
            $query->orWhere('status', 'like', "%" . $search . "%");
            $query->orWhere('description', 'like', "%" . $search . "%");
            $query->orWhere('cost', 'like', "%" . $search . "%");
        });

        $orderByName = 'product';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'product';
                break;
            case '2':
                $orderByName = 'cost';
                break;
            case '3':
                $orderByName = 'status';
                break;
            case '4':
                $orderByName = 'category';
                break;
            case '5':
                $orderByName = 'subcategory';
                break;
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $products = $query->skip($skip)->take($pageLength)->get();
        // dd($products);

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $products], 200);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = MainCategory::with('subcategories')->get();
        // return view('product.view',compact('categories'));

        return view('product.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MainCategory::with('subcategories')->get();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,svg',
            'cost' => 'required|numeric|regex:/^\d*\.\d{1}[0-9]?$/',
            'product' => 'required|unique:products,product',
            'product_status' => 'required',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'addMoreInputFields.*.specification' => 'required',
        ]);

        $product = new Product();
        $product->product = $request->product;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->status = $request->product_status;
        $product->main_category_id = $request->category;
        $product->sub_category_id = $request->subcategory;
        $product->save();

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $images = new ProductImage();
                $images->product_id = $product->id;
                $images->title = $file->getClientOriginalName();
                $images->path = $file->storeAs('images', $file->getClientOriginalName());
                $images->save();
            }
        }

        foreach ($request->addMoreInputFields as $value) {
            foreach ($value as $k => $v) {
                $spec = new ProductSpecification();
                $spec->product_id = $product->id;
                $spec->specification = $v;
                $spec->save();
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
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
        $categories = MainCategory::with('subcategories')->get();
        $product = Product::find($id);
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg',
            'cost' => 'required|numeric|regex:/^\d*\.\d{1}[0-9]?$/',
            'product' => 'required',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'product_status' => 'required',
            'addMoreInputFields.*.specification' => 'required',
        ]);

        $product = Product::find($id);

        $all = DB::select('select id from product_images where product_id = ?', [$product->id]);
        $i = 0;
        foreach ($all as $img) {
            $dbimg[$i++] = $img->id;
        }
        if($request->oldimg){
            $oldimg = $request->oldimg;
            $deleted = array_diff($dbimg, $oldimg);
            foreach ($deleted as $id) {
                $result = ProductImage::where('id', $id);
                // dd($result);
                $result->delete();
            }
        }else{
            $result = ProductImage::where('id', $product->id);
            // dd($result);
            $result->delete();
        }


        $product->product = $request->product;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->status = $request->product_status;
        $product->main_category_id = $request->category;
        $product->sub_category_id = $request->subcategory;
        $product->update();

        $insert = [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $insert[$key]['title'] = $file->getClientOriginalName();
                $insert[$key]['path'] = $file->store('images');
                $insert[$key]['product_id'] = $product->id;
            }
            ProductImage::insert($insert);
        }

        $product_spec = ProductSpecification::where('product_id', $product->id);
        $product_spec->delete();
        $upload = [];
        foreach ($request->addMoreInputFields as $key => $value) {
            foreach ($value as $k => $v) {
                $upload[$key]['specification'] = $v;
                $upload[$key]['product_id'] = $product->id;
            }
        }
        ProductSpecification::insert($upload);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $images = ProductImage::where('product_id', $id)->get();
        $specs = ProductSpecification::where('product_id', $id)->get();
        $images->each->delete();
        $specs->each->delete();
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
