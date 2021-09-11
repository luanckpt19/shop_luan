<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    use DeleteModelTrait;
    private $order;
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    public function index(Request $request)
    {
        $sort = $request->query('sort', "");
        $searchKeyword = $request->query('name', "");

        $queryORM = Order::where('customer_name', "LIKE", "%" . $searchKeyword . "%");

        if ($sort == "name_asc") {
            $queryORM->orderBy('customer_name', 'asc');
        }
        if ($sort == "name_desc") {
            $queryORM->orderBy('customer_name', 'desc');
        }

        $orders = $queryORM->paginate(10);

        // truyền dữ liệu xuống view
        $data = [];
        $data["orders"] = $orders;

        // truyền keyword search xuống view
        $data["searchKeyword"] = $searchKeyword;
        $data["sort"] = $sort;

        $order_status_defined = [];
        $order_status_defined[1] = "Đang chờ xác nhận";
        $order_status_defined[2] = "Đã xác nhận";
        $order_status_defined[3] = "Đang vận chuyển";
        $order_status_defined[4] = "Hoàn tất";
        $order_status_defined[5] = "Đơn hủy";
        $order_status_defined[6] = "Đã hoàn tiền ( hủy đơn )";

        $data["order_status_defined"] = $order_status_defined;

        return view("admin.order.index", $data);
    }
    public function searchProduct(Request $request) {
        $searchKeyword = $request->input("search", "");

        $queryORM = Product::where('product_name', "LIKE", "%".$searchKeyword."%");
        $products = $queryORM->paginate(10);
        $msg["results"] = [];

        if ($products) {
            foreach ($products as $product) {
                $msg["results"][] = ["id" => $product->id, "text" => $product->id . " - " . $product->product_name];
            }
        }

        return response()->json($msg, 200);
    }
    public function ajaxSingleProduct(Request $request) {
        $id = (int) $request->input("id", "");

        $product = Product::findOrFail($id);

        $productShort = [
            "id" => $product->id,
            "product_name" => $product->product_name,
            "product_image" => $product->product_image,
            "product_quantity" => $product->product_quantity,
            "product_price" => $product->product_price,
        ];

        $productShort["product_image"] = str_replace("public/", "", $productShort["product_image"]);

        $productShort["product_image"] = asset('storage')."/".$productShort["product_image"];

        return response()->json($productShort, 200);
    }

    public function create() {

        return view("admin.order.add");
    }

    public function edit($id) {

        $order = Order::find($id);

        $product = Product::find($id);
        $productOrders =session()->get('productOrders');
        $productOrders[$id]=[
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->price,
            'quantity'=>1,
            'image'=>$product->feature_image_path,
        ];

        $productInOrders = DB::table('products')
            ->join('orderdetail', 'orderdetail.id', '=', 'products.id')
            ->select('products.id','products.name', 'products.feature_image_path', 'orderdetail.order_id', 'orderdetail.quantity', 'orderdetail.product_price')
            ->where('orderdetail.order_id', '=', $id)
            ->get();

        // truyền dữ liệu xuống view
        $data = [];
        $data["order"] = $order;
        $data["productOrders"]= $productOrders;
        $data["productInOrders"] = $productInOrders;

        return view("admin.order.edit", $data);
    }


    public function store(Request $request) {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        // validate dữ liệu
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'order_status' => 'required',
            'order_note' => 'required',
        ]);

        if (empty($product_ids) || empty($product_quatities)) {
            return redirect("/backend/orders/create")->withInput()->withErrors(["product_ids" => "chưa chọn sản phẩm cho đơn hàng"]);
        }

        $customer_name = $request->input('customer_name', '');
        $customer_email = $request->input('customer_email', '');
        $customer_phone = $request->input('customer_phone', '');
        $customer_address = $request->input('customer_address', '');
        $order_status = $request->input('order_status', '');
        $order_note = $request->input('order_note', '');
        $product_ids = $request->input('product_ids');
        $product_quatities = $request->input('product_quatity');

        $order = new Order();

        $order->customer_name = $customer_name;
        $order->customer_email = $customer_email;
        $order->customer_phone = $customer_phone;
        $order->customer_address = $customer_address;
        $order->order_status = $order_status;
        $order->order_note = $order_note;

        // thêm chi tiết đơn hàng
        foreach($product_ids as $product_ids_key => $productId) {

            $quantity = $product_quatities[$product_ids_key];
            $product = Product::find($productId);
            $totalPriceProduct = $quantity*$product->price;

            $order->total_product += $quantity;
            $order->total_price += $totalPriceProduct;
        }

        // lưu đơn hàng
        $order->save();

        // thêm chi tiết đơn hàng
        foreach($product_ids as $product_ids_key => $productId) {

            $quantity = $product_quatities[$product_ids_key];
            $product = Product::find($productId);
            $totalPriceProduct = $quantity*$product->product_price;

            $orderDetail = new OrderDetail();

            $orderDetail->product_id = $productId;
            $orderDetail->product_price = $product->price;
            $orderDetail->quantity = $quantity;
            $orderDetail->order_id = $order->id;
            $orderDetail->order_status = $order_status;
            $orderDetail->save();
        }

        return redirect("/admin/orders/index")->with('status', 'thêm đơn hàng thành công !');
    }

    // phương thức sẽ nhập data post đi và cập
    // nhật vào trong CSDL
    public function update(Request $request, $id) {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        // validate dữ liệu
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'order_status' => 'required',
            'order_note' => 'required',
        ]);

        $customer_name = $request->input('customer_name', '');
        $customer_email = $request->input('customer_email', '');
        $customer_phone = $request->input('customer_phone', '');
        $customer_address = $request->input('customer_address', '');
        $order_status = $request->input('order_status', '');
        $order_note = $request->input('order_note', '');

        $order = Order::findOrFail($id);

        $order->customer_name = $customer_name;
        $order->customer_email = $customer_email;
        $order->customer_phone = $customer_phone;
        $order->customer_address = $customer_address;
        $order->order_status = $order_status;
        $order->order_note = $order_note;

        // lưu đơn hàng
        $order->save();

        $orderDetails = DB::table('orderdetail')->where("order_id", $order->id)->get();

        foreach($orderDetails as $orderDetail) {

            $orderDetail = OrderDetail::findOrFail($orderDetail->id);
            $orderDetail->order_status = $order_status;
            $orderDetail->save();
        }

        return redirect()->route('admin.orders.index')->with('status', 'cập nhật đơn hàng thành công !');
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->order);
    }

}
