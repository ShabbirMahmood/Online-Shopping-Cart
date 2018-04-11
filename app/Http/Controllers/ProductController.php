<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Product;
use App\Order;
use App\Cart;
use Session;
use Auth;
use DB;

class ProductController extends Controller
{
    public function getIndex(){
        $products = DB::table('products')->orderBy('id', 'DESC')->paginate(12);
        return view('shop.index',['products' => $products]);
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('product.index');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart  = new Cart($oldCart);

        return view('shop.shopping-cart',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.check', ['total' => $total]);
    }

    public function postCheckout(Request $request) {

        if (!Session::has('cart')) {
            return redirect()->route('product.shoppingcart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        //return $cart->items;
        foreach ($cart->items as $item)
            {
                $dbVar = Product::find($item["item"]["id"]);
                $var = $dbVar->stock;

                $var -= $item["qty"];

                if($var < 0){

                    $cart->removeItem($item["item"]["id"]);

                }else
                {
                    $dbVar->stock = $var;

                    $dbVar->save();
                }


            }

            if($cart->items != null)
            {
                $dbVar= new Order();

                $dbVar->userId = Auth::User()->id;
                $dbVar->price = $cart->totalPrice;
                $dbVar->cart = serialize($cart);
                $dbVar->save();


                Session::forget('cart');

                return redirect()->route('product.index')->with('success','Your Order has been placed Successfully');
            }

        Session::forget('cart');

        return redirect()->route('product.index')->with('success','No Products to Placed!');


    }

    public function deductByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deductByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingcart');
    }

    public function removeItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingcart');
    }
}
