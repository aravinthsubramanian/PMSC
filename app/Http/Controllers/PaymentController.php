<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function cart()
    {
        $quantities = DB::table('cart')
            ->where('user_id', Auth::user()->id)
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->select('products.id', 'products.cost', 'quantity')->get();

        $ids = [];
        foreach ($quantities as $id) {
            $ids[] = $id->id;
        }

        $products = Product::findMany($ids);

        $total = 0;
        foreach ($quantities as $quantity) {
            $total += $quantity->quantity * $quantity->cost;
        }

        return view('payment.cart', compact('products', 'quantities', 'total'));
    }

    public function addcart($id)
    {
        $userid = Auth::User()->id;
        $productid = $id;
        $quantity = 1;

        $cart = DB::table('cart')->where([['user_id', $userid], ['product_id', $productid]])->get();
        if (count($cart) > 0) {
            DB::update('update cart set quantity = ? where user_id = ? and product_id = ?', [$quantity + $cart[0]->quantity, $userid, $productid]);
            return redirect()->route('payment.cart')->with('success', 'product added to cart..');
        }
        $cart = DB::insert('insert into cart (user_id, product_id, quantity) values (?, ?, ?)', [$userid, $productid, $quantity]);
        return redirect()->route('payment.cart')->with('success', 'product added to cart..');
    }

    public function addcarts($id, $qty)
    {
        $userid = Auth::User()->id;
        $productid = $id;
        $quantity = $qty;

        $cart = DB::table('cart')->where([['user_id', $userid], ['product_id', $productid]])->get();
        // dd($productid, $quantity);

        if (count($cart) > 0) {
            DB::update('update cart set quantity = ? where user_id = ? and product_id = ?', [$quantity + $cart[0]->quantity, $userid, $productid]);
            return redirect()->route('payment.cart')->with('success', 'product added to cart..');
        }
        $cart = DB::insert('insert into cart (user_id, product_id, quantity) values (?, ?, ?)', [$userid, $productid, $quantity]);

        return redirect()->route('payment.cart')->with('success', 'product added to cart..');
    }

    public function editcart($id, $qty)
    {
        $userid = Auth::User()->id;
        $productid = $id;
        $quantity = $qty;

        // dd($userid, $productid, $quantity);
        DB::update('update cart set quantity = ? where user_id = ? and product_id = ?', [$quantity, $userid, $productid]);

        $quantities = DB::table('cart')
            ->where('user_id', $userid)
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->select('products.id', 'products.cost', 'quantity')->get();

        $total = 0;
        foreach ($quantities as $quantity) {
            $total += $quantity->quantity * $quantity->cost;
        }

        // return response()->json(["quantity" => $quantity, "product" => $productid], 200);
        return response()->json(["total" => $total], 200);
    }

    public function buy($id)
    {
        $product = Product::find($id);
        return view('payment.buy', compact('product'));
    }

    public function session(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $productname = $request->get('productname');
        $totalprice = intval($request->get('total'));
        $quantity = $request->quantity;
        $two0 = "00";
        $total = "$totalprice$two0";

        $products = [
            [
                'price_data' => [
                    'currency' => 'INR',
                    'product_data' => [
                        "name" => $productname,
                    ],
                    'unit_amount' => $total,
                ],
                'quantity' => $quantity,
            ],
        ];

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $products,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('users.product'),
        ]);

        return redirect()->away($session->url);
    }

    public function sessioncart(){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $userid = Auth::User()->id;

        $alldata = DB::table('cart')
            ->where('user_id', $userid)
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->select('products.id', 'products.product', 'products.cost', 'quantity')->get();

        $products=[];
        $two0 = "00";
        
        foreach($alldata as $data){
            $val =intval($data->cost);
            $price = "$val$two0";
            
            $products[] = [
                'price_data' => [
                    'currency' => 'INR',
                    'product_data' => [
                        "name" => $data->product,
                    ],
                    'unit_amount' => $price,
                ],
                'quantity' => $data->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $products,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('users.product'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return redirect()->route('users.product')->with('success', 'Product ordered successfully...');
    }

    public function deletecart($id)
    {
        DB::delete('delete from cart where user_id = ? and product_id = ?', [Auth::User()->id, $id]);

        return back()->with('success','Product removed sucessfully...');
    }
}
