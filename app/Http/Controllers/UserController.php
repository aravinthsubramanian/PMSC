<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:USER_READ'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:USER_CREATE'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:USER_UPDATE'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:USER_DELETE'], ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function filerproducts(Request $request)
    {
        if($request->search){
            if(!$request->category | !$request->subcategory) {
                $products = Product::where('product', 'like', "%$request->search%")->get();
                $categories = MainCategory::with('subcategories')->get();
                return view('user.product', compact('products','categories'));
            }
            $products = Product::where([['product', 'like', "%$request->search%"],['main_category_id',$request->category],['sub_category_id',$request->subcategory]])->get();
            $categories = MainCategory::with('subcategories')->get();
            return view('user.product', compact('products','categories'));
        }
        
        if($request->category && $request->subcategory) {
            $products = Product::where([['main_category_id',$request->category],['sub_category_id',$request->subcategory]])->get();
            $categories = MainCategory::with('subcategories')->get();
            // $oldcat = MainCategory::find($request->category);
            // $oldsubcat = SubCategory::find($request->subcategory);
            // $subs = SubCategory::with('products')->where('main_category_id',$request->category)->get();
            // return view('user.filterproduct', compact('products','categories','oldcat','oldsubcat','subs'));
            return view('user.product', compact('products','categories'));
        }

        return redirect(route('users.product'));
    }


    /**
     * Display a listing of the resource.
     */
    public function products()
    {
        $products = Product::all();
        $categories = MainCategory::with('subcategories')->get();
        return view('user.product', compact('products','categories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function forgotpassword()
    {
        return view('user.forgotpassword');
    }

    /**
     * Display a listing of the resource.
     */
    public function sendmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:64|exists:users,email',
        ]);

        $results = DB::table('password_reset_tokens')->where('email', $request->email)->orderBy('id', 'desc')->first();

        $td = number_format(date('i', strtotime(Carbon::now()->toDateTimeString()) - strtotime($results->created_at)));
        if (!empty($results)) {
            if ($td < 5)
                return back()->with("error", "So many attempts try again later...");
        }
        DB::table('password_reset_tokens')->where([['email', $request->email]])->delete();
        $token = Str::random(64);
        Mail::send("email.useremail", ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
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
        return view('user.resetpassword', compact('token', 'email'));
    }

    /**
     * Display a listing of the resource.
     */
    public function updatepassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|max:64|exists:users,email',
            'npassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols()],
            'cpassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols(), 'same:npassword'],
        ]);
        $updatepassword = DB::table('password_reset_tokens')->where([['email', $request->email], ['token', $request->token]])->first();
        if (!$updatepassword) {
            return redirect()->to(route('users.resetpassword'))->with("error", "email not valid....");
        }
        User::where('email', $request->email)->update(["password" => Hash::make($request->npassword)]);
        DB::table('password_reset_tokens')->where([['email', $request->email]])->delete();
        return redirect()->to(route('users.loginoption'))->with("success", "Password reset successfully....");
    }


    /**
     * Display a listing of the resource.
     */
    public function registeroption()
    {
        return view('user.register');
    }

    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z .]+$/',
            'email' => 'required|email:rfc,dns|max:64|unique:users,email',
            'mobile' => 'required|digits:10',
            'npassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols()],
            'cpassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols(), 'same:npassword'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => 'enable',
            'password' => Hash::make($request->npassword),
        ]);
        return redirect()->route('users.loginoption')->with('success', 'Registered successfully...');
    }

    /**
     * Display a listing of the resource.
     */
    public function loginoption()
    {
        return view('user.login');
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
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('users.dashboard')->with('success', 'Login successfully...');
        }
        return back()->with('error', 'Invalid Username or Password...');
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.view', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z .]+$/',
            'email' => 'required|email:rfc,dns|max:64|unique:admins,email',
            'mobile' => 'required|digits:10',
            'npassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols()],
            'cpassword' => ['required', Password::min(6)->max(18)->mixedCase()->numbers()->symbols(), 'same:npassword'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => Hash::make($request->npassword)
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
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
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required',
            'name' => 'required|min:2|max:32|regex:/^[a-zA-Z .]+$/',
            'mobile' => 'required|digits:10',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        $user->update();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to(route('users.loginoption'))->with('success', 'logout successfully!');
    }
}
