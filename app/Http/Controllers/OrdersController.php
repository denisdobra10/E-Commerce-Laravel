<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
    public function showorders()
    {
        return view('admin.showorders');
    }

    public function MarkOrderAsFinished(Request $req)
    {
        DB::update('UPDATE orders SET status = ? WHERE id = ?', ['finished', $req->orderId]);

        echo "Order status has been successfully updated!<br/>";
        echo '<a href = "showorders">Click Here</a> to go back.';
    }

    public static function GetOrders()
    {
        return Order::all();
    }

    public function DeleteOrder(Request $req)
    {
        Order::find($req->orderId)->forceDelete();

        echo "Order has been successfully deleted from database!<br/>";
        echo '<a href = "showorders">Click Here</a> to go back.';
    }

    public function DeleteAllOrders()
    {
        foreach(Order::all() as $order)
        {
            $order->forceDelete();
        }

        echo "Every order has been successfully erased from dataabse!<br/>";
        echo '<a href = "showorders">Click Here</a> to go back.';
    }
}
