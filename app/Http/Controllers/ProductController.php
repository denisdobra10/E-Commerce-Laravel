<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProductController extends Controller
{

    public function index()
    {
        $data = Product::all();
        return view('products.index')->with('products', $data);
    }

    public function details($id)
    {
        $data = Product::find($id);

        return view('products.details', ['product' => $data]);
    }
    
    public function CreateProduct(Request $req)
    {
        // Save image on server
        $image = $req->file('gallery');

        $fileName = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $fileName);

        // Add product to database
        $product = new Product;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->description = $req->description;
        $product->gallery = $fileName;

        $product->save();


        echo "Record created successfully.<br/>";
        echo '<a href = "/">Click Here</a> to go back.';
    }

    public function EditProduct($id)
    {
        return view('admin.edit-product', ['productId' => $id]);
    }

    public function ModifyProduct(Request $req)
    {

        DB::update('UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?',[$req->name, $req->price, $req->description, $req->id]);

        echo "Record updated successfully.<br/>";
        echo '<a href = "/">Click Here</a> to go back.';
    }

    public function DeleteProduct($id)
    {
        $targetedProduct = Product::find($id);

        $targetedProduct->forceDelete();

        return redirect('/');
    }

    public function AddToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;

            $cart->save();

            return redirect('/');

        }
        else
        {
            return redirect('login');
        }

    }

    public static function CartItems()
    {
        if(session()->has('user'))
            return Cart::where('user_id', session()->get('user')['id'])->count();
        else
            return 0;
    }

    public static function GetProductInfo($id)
    {
        return Product::find($id);
    }

    public function CartList()
    {
        $userId = session()->get('user')['id'];

        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();

        return view('cartlist', ['products' => $products]);

    }

    public static function GetCartProducts()
    {
        $userId = session()->get('user')['id'];

        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();

        return $products;

    }

    public function RemoveProductFromCart($id)
    {
        Cart::find($id)->forceDelete();

        return redirect('/');
    }


    public function PlaceOrder(Request $req)
    {
        // Prepare necessary details for new order
        $cartItems = $this->GetCartProducts();
        $productIds = "";
        $userId = session()->get('user')['id'];
        $status = "processed";
        $paymentMethod = $req->payment;
        $address = $req->address;
        $amount = 0;

        foreach($cartItems as $item)
        {
            $productIds = $productIds . $item->id . ',';
            $amount += $item->price;
        }

        // Create new order and save to database
        $newOrder = new Order;
        $newOrder->products_ids = $productIds;
        $newOrder->user_id = $userId;
        $newOrder->status = $status;
        $newOrder->payment_method = $paymentMethod;
        $newOrder->address = $address;
        $newOrder->amount = $amount;

        $newOrder->save();

        // Delete user's card from database
        foreach($cartItems as $item)
        {
            Cart::find($item->cart_id)->forceDelete();
        }

        // Give success message to user

        echo "Your order has been successfully placed!.<br/>";
        echo '<a href = "/">Click Here</a> to go back.';

        return $paymentMethod;
    }

    public function BuyNow(Request $req)
    {
        $this->AddToCart($req);

        return view('products.order');
    }
}
