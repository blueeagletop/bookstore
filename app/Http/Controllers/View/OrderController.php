<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\CartItem;
use App\Entity\Book;
use App\Entity\Order;
use App\Entity\OrderItem;
//use App\Models\BKWXJsConfig;
//use App\Tool\WXpay\WXTool;
use Log;

class OrderController extends Controller {

//    public function toOrderPay(Request $request) {
//        return view('order_pay');
//    }

    public function toOrderCommit(Request $request) {

//        return view('order_commit');
        
//        // 获取微信重定向返回的code
//        $code = $request->input('code', '');
//        if ($code != '') {
//            //获取code码，以获取openid
//            $openid = WXTool::getOpenid($code);
//            // 将openid保存到session
//            $request->session()->put('openid', $openid);
//        }
//
        $book_ids = $request->input('book_ids', '');

        $book_ids_arr = ($book_ids != '' ? explode(',', $book_ids) : array());

        $member = $request->session()->get('member', '');
        $cart_items = CartItem::where('member_id', $member->id)->whereIn('book_id', $book_ids_arr)->get();

        $order = new Order;
        $order->member_id = $member->id;
        $order->save();

        $cart_items_arr = array();
//        $cart_items_ids_arr = array();
        $total_price = 0;
        $name = '';
        foreach ($cart_items as $cart_item) {
            $cart_item->book = Book::find($cart_item->book_id);
            if ($cart_item->book != null) {
                $total_price += $cart_item->book->price * $cart_item->count;
                $name .= ('《' . $cart_item->book->title . '》');
                array_push($cart_items_arr, $cart_item);
//                array_push($cart_items_ids_arr, $cart_item->id);
//
                $order_item = new OrderItem;
                $order_item->order_id = $order->id;
                $order_item->book_id = $cart_item->book_id;
                $order_item->count = $cart_item->count;
                $order_item->book_snapshot = json_encode($cart_item->book);
                $order_item->save();
            }
        }
        
        //清空购物车
        CartItem::where('member_id', $member->id)->delete();
//        CartItem::whereIn('id', $cart_items_ids_arr)->delete();
//
//        $order = new Order;
        $order->name = $name;
        $order->total_price = $total_price;
        $order->order_no = 'E' . time() . 'D' . $order->id;
        $order->save();
//        return $order;

//        // JSSDK 相关
//        $access_token = WXTool::getAccessToken();
//        $jsapi_ticket = WXTool::getJsApiTicket($access_token);
//        $noncestr = WXTool::createNonceStr();
//        $timestamp = time();
//        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//        // 签名
//        $signature = WXTool::signature($jsapi_ticket, $noncestr, $timestamp, $url);

        // 返回微信参数
//        $bk_wx_js_config = new BKWXJsConfig;
//        $bk_wx_js_config->appId = config('wx_config.APPID');
//        $bk_wx_js_config->timestamp = $timestamp;
//        $bk_wx_js_config->nonceStr = $noncestr;
//        $bk_wx_js_config->signature = $signature;

        return view('order_commit')->with('cart_items', $cart_items_arr)
                ->with('total_price', $total_price)
                ->with('name', $name)
                ->with('order_no', $order->order_no);
//        return view('order_commit')->with('cart_items', $cart_items_arr)
//                        ->with('total_price', $total_price)
//                        ->with('name', $name)
//                        ->with('order_no', $order->order_no)
//                        ->with('bk_wx_js_config', $bk_wx_js_config);
    }

    public function toOrderList(Request $request) {
        //return view('order_list');
        $member = $request->session()->get('member', '');
        $orders = Order::where('member_id', $member->id)->get();
        foreach ($orders as $order) {
            $order_items = OrderItem::where('order_id', $order->id)->get();
            $order->order_items = $order_items;
            foreach ($order_items as $order_item) {
//                $order_item->book = Book::find($order_item->book_id);
                $order_item->book = json_decode($order_item->book_snapshot);
            }
        }
        
        //return $orders;
        return view('order_list')->with('orders', $orders);
    }

}
