<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addToCart($id){

//        session()->flush('cart');
        $product = Product::find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity']= $cart[$id]['quantity'] + 1;
        }else{
            $cart[$id]=[
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>1,
                'image'=>$product->feature_image_path,
            ];
        }
        session()->put('cart',$cart);
        return response()->json([
            'code'=>200,
            'message'=>'success'
        ],200);
    }

    public function showCart(){
        $categoryLimit = Category::where('parent_id',0)->take(5)->get();
        $carts = session()->get('cart');
        return view('product.cart',compact('carts','categoryLimit'));
    }
    public function updateCart(Request $request){
        if ($request ->id && $request->quantity){
            $carts = session()->get('cart');
            $carts[$request->id]['quantity']=$request->quantity;
            session()->put('cart',$carts);
            $carts = session()->get('cart');
            $categoryLimit = Category::where('parent_id',0)->take(5)->get();
            $cartComponent = view('product.cart',compact('carts','categoryLimit'))->render();
            return response()->json([
                'cart_component'=>$cartComponent,
                'code'=>200
            ],200);
        }
    }
    public function deleteCart(Request $request){
        if ($request ->id ){
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart',$carts);
            $carts = session()->get('cart');
            $categoryLimit = Category::where('parent_id',0)->take(5)->get();
            $cartComponent = view('product.cart',compact('carts','categoryLimit'))->render();
            return response()->json([
                'cart_component'=>$cartComponent,
                'code'=>200
            ],200);
        }
    }

    public function payment(){
        $categoryLimit = Category::where('parent_id',0)->take(5)->get();
        $carts = session()->get('cart');
        return view('product.payment',compact('categoryLimit','carts'));
    }
}
