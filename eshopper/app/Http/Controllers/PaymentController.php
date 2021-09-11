<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function shareKey()
    {
        $cart = new Cart();
        $totalQttCart = $cart->getTotalQuantity();
        $totalPriceCart = $cart->getTotalPrice();
        view()->share('totalQttCart', $totalQttCart);
        view()->share('totalPriceCart', $totalPriceCart);
    }

    public function index() {

        $this->shareKey();

        $categories = DB::table("category")->get();

        $data = [];
        $data["categories"] = $categories;


        $cart = new Cart();
        $data["cart"] =  $cart->getItems();

        $cartIds = [];

        foreach($data["cart"] as $id => $valCart) {
            $cartIds[] = $id;
        }
        $products = DB::table("products")->whereIn("id", $cartIds)->get();
        $data["products"] = $products;

    }


    public function checkout(Request $request) {

        $this->shareKey();

        // validate
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'order_note' => 'required',
        ]);


        // lấy thông tin từ khách hàng
        $customer_name = $request->get("customer_name", "");
        $customer_address = $request->get("customer_address", "");
        $customer_phone = $request->get("customer_phone", "");
        $customer_email = $request->get("customer_email", "");
        $order_note = $request->get("order_note", "");


        // lấy thông tin từ giỏ hàng

        $cart = new Cart();
        $data["cart"] =  $cart->getItems();

        // insert đơn hàng
        $order = new Order();

        $order->customer_name = $customer_name;
        $order->customer_email = $customer_email;
        $order->customer_phone = $customer_phone;
        $order->customer_address = $customer_address;
        $order->order_status = 1;
        $order->order_note = $order_note;

        // thêm chi tiết đơn hàng
        $carts = session()->get('cart');
        foreach($carts as $id => $cartItem) {

            $quantity = $cartItem['quantity'];
            $product = Product::find($id);
            $totalPriceProduct = $cartItem['price'] * $cartItem['quantity'];

            $order->total_product += $quantity;
            $order->total_price += $totalPriceProduct;
        }

        // lưu đơn hàng
        $order->save();

        // thêm chi tiết đơn hàng
        foreach($carts as $id => $cartItem) {

            $quantity = $cartItem['quantity'];
            $product = Product::find($id);

            $orderDetail = new OrderDetail();

            $orderDetail->product_id = $id;
            $orderDetail->product_price = $cartItem['price'];
            $orderDetail->quantity = $quantity;
            $orderDetail->order_id = $order->id;
            $orderDetail->order_status = 1;
            $orderDetail->save();
        }

        $cart->clearCart();

    }

}
