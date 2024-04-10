<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:ADMIN_READ'], ['only' => ['index', 'show', 'fetch']]);
        $this->middleware(['permission:ADMIN_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:ADMIN_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:ADMIN_DELETE'], ['only' => ['destroy']]);
        $this->middleware(['permission:USER_READ'], ['only' => ['users', 'userfetch']]);
    }




    /**
     * Display a listing of the resource.
     */
    public function fetch(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        // get data from products table
        $query = DB::table('roles')->join('model_has_roles', 'model_has_roles.role_id','=','roles.id')
        ->join('admins', 'admins.id','=','model_has_roles.model_id')
        ->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('ad_name', 'like', "%" . $search . "%");
            $query->orWhere('name', 'like', "%" . $search . "%");
            $query->orWhere('mobile', 'like', "%" . $search . "%");
            $query->orWhere('email', 'like', "%" . $search . "%");
            $query->orWhere('status', 'like', "%" . $search . "%");
        });

        $orderByName = 'ad_name';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'name';
                break;
            case '2':
                $orderByName = 'ad_name';
                break;
            case '3':
                $orderByName = 'mobile';
                break;
            case '4':
                $orderByName = 'email';
                break;
            case '5':
                $orderByName = 'status';
                break;
            case '6':
                $orderByName = 'created_at';
                break;
            // case '7':
            //     $orderByName = 'updated_at';
            //     break;
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $admins = $query->skip($skip)->take($pageLength)->get();
        // dd($admins);

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $admins], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function userfetch(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        // get data from products table
        $query = DB::table('users')->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('name', 'like', "%" . $search . "%");
            $query->orWhere('mobile', 'like', "%" . $search . "%");
            $query->orWhere('email', 'like', "%" . $search . "%");
            $query->orWhere('status', 'like', "%" . $search . "%");
        });

        $orderByName = 'name';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'name';
                break;
            case '2':
                $orderByName = 'mobile';
                break;
            case '3':
                $orderByName = 'email';
                break;
            case '4':
                $orderByName = 'status';
                break;
            case '5':
                $orderByName = 'created_at';
                break;
            case '6':
                $orderByName = 'updated_at';
                break;
        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $users = $query->skip($skip)->take($pageLength)->get();
        // dd($permissions);

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $users], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function forgotpassword()
    {
        return view('admin.forgotpassword');
    }

    /**
     * Display a listing of the resource.
     */
    public function sendmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:64|exists:admins,email',
        ]);

        $results = DB::table('password_reset_tokens')->where('email', $request->email)->orderBy('id', 'desc')->first();

        $td = number_format(date('i', strtotime(Carbon::now()->toDateTimeString()) - strtotime($results->created_at)));
        if (!empty($results)) {
            if ($td < 5)
                return back()->with("error", "So many attempts try again later...");
        }
        DB::table('password_reset_tokens')->where([['email', $request->email]])->delete();
        $token = Str::random(64);
        Mail::send("email.adminemail", ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset password");
        });
        
        DB::table('password_reset_tokens')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);
        
        return back()->with("success", "Email send successfully");
    }

    /**
     * Display a listing of the resource.
     */
    public function resetpassword(Request $request, $token)
    {
        $email = $request->email;
        return view('admin.resetpassword', compact('token', 'email'));
    }

    /**
     * Display a listing of the resource.
     */
    public function updatepassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:64|exists:admins,email',
            'npassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols()],
            'cpassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols(), 'same:npassword'],
        ]);
        $updatepassword = DB::table('password_reset_tokens')->where([['email', $request->email], ['token', $request->token]])->orderBy('id', 'desc')->first();
        
        if (!$updatepassword) {
            return redirect()->to(route('users.resetpassword'))->with("error", "email not valid....");
        }
        Admin::where('email', $request->email)->update(["password" => Hash::make($request->npassword)]);
        DB::table('password_reset_tokens')->where([['email', $request->email]])->delete();
        return redirect()->to(route('admins.loginoption'))->with("success", "Password reset successfully....");
    }

    /**
     * Display a listing of the resource.
     */
    public function loginoption()
    {
        return view('admin.login');
    }

    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('admins.dashboard'))->with('success', 'Login successfully...');
        }
        return back()->with('error', 'Invalid Username or Password...');
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $permissions_count = Permission::all()->count();
        $roles_count = Role::all()->count();
        $admins_count = Admin::all()->count();
        $users_count = User::all()->count();
        $categories_count = MainCategory::all()->count();
        $subcategories_count = SubCategory::all()->count();
        $products_count = Product::all()->count();
        return view('admin.dashboard', compact('permissions_count', 'roles_count', 'admins_count', 'users_count', 'categories_count', 'subcategories_count', 'products_count'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $admins = Admin::all();
        // return view('admin.view', compact('admins'));
        return view('admin.show');
    }

    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        // $users = User::all();
        // return view('user.view', compact('users'));
        return view('user.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'status' => 'required',
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z .]+$/',
            'email' => 'required|email:rfc,dns|max:64|unique:admins,email',
            'mobile' => 'required|digits:10',
            'npassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols()],
            'cpassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols(), 'same:npassword'],
        ]);

        $admin = new Admin();
        $admin->ad_name = $request->name;
        $admin->email = $request->email;
        $admin->status = $request->status;
        $admin->mobile = $request->mobile;
        $admin->password = Hash::make($request->npassword);
        $admin->save();
        $admin->assignRole([$request->role]);

        return redirect()->route('admins.index')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function myprofile(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.myprofile', compact('admin'));
    }

    /**
     * Display the specified resource.
     */
    public function proupdate(string $id,Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z .]+$/',
            'mobile' => 'required|digits:10',
        ]);
        $admin = Admin::find($id);
        $admin->ad_name = $request->name;
        $admin->mobile = $request->mobile;
        $admin->update();

        return back()->with('success', 'Updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function mypassword(string $id)
    {
        $admin = Admin::find($id);
        return view('admin.mypassword', compact('admin'));
    }

    /**
     * Display the specified resource.
     */
    public function updatepass(string $id,Request $request)
    {
        $request->validate([
            'password' => 'required',
            'npassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols()],
            'cpassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols(), 'same:npassword'],
        ]);
        $admin = Admin::find($id);
        
        if(Hash::check($request->password, $admin->password)){
            $admin->password = Hash::make($request->npassword);
            $admin->update();
            return back()->with('success', 'Updated successfully');
        }
        return back()->with('error', 'Password Invalid...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::orderBy('name')->get();
        $admin = Admin::find($id);
        return view('admin.edit', compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required',
            'status' => 'required',
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z .]+$/',
            'mobile' => 'required|digits:10',
        ]);
        $admin = Admin::find($id);
        $admin->ad_name = $request->name;
        $admin->mobile = $request->mobile;
        $admin->status = $request->status;
        $admin->update();

        $admin->assignRole([$request->role]);

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to(route('admins.loginoption'))->with('success', 'logout successfully!');
    }
}
