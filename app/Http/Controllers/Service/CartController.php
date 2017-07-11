<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M3Result;
use App\Entity\CartItem;

class CartController extends Controller
{
  public function addCart(Request $request, $book_id)
  {
    $m3_result = new M3Result;
    $m3_result->status = 0;
    $m3_result->message = '添加成功';

    // 如果当前已经登录
    $member = $request->session()->get('member', '');
    if($member != '') {
      $cart_items = CartItem::where('member_id', $member->id)->get();

      $exist = false;
      foreach ($cart_items as $cart_item) {
        if($cart_item->book_id == $book_id) {
          $cart_item->count ++;
          $cart_item->save();
          $exist = true;
          break;
        }
      }

      //不存在则存储进来
      if($exist == false) {
        $cart_item = new CartItem;
        $cart_item->book_id = $book_id;
        $cart_item->count = 1;
        $cart_item->member_id = $member->id;
        $cart_item->save();
        
      }

      return $m3_result->toJson();
    }

    $bk_cart = $request->cookie('bk_cart');
    //return $bk_cart;
    $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());

    $count = 1;
    foreach ($bk_cart_arr as &$value) {   // 重点：一定要传引用
      $index = strpos($value, ':');
      if(substr($value, 0, $index) == $book_id) {
        $count = ((int) substr($value, $index+1)) + 1;
        $value = $book_id . ':' . $count;
        break;
      }
    }

    if($count == 1) {
      array_push($bk_cart_arr, $book_id . ':' . $count);
    }

    return response($m3_result->toJson())->withCookie('bk_cart', implode(',', $bk_cart_arr));
  }

  public function deleteCart(Request $request)
  {
    $m3_result = new M3Result;
    $m3_result->status = 0;
    $m3_result->message = '删除成功';

    $book_ids = $request->input('book_ids', '');
    if($book_ids == '') {
      $m3_result->status = 1;
      $m3_result->message = '书籍ID为空';
      return $m3_result->toJson();
    }
    $book_ids_arr = explode(',', $book_ids);

    $member = $request->session()->get('member', '');
    if($member != '') {
        // 已登录
        CartItem::whereIn('book_id', $book_ids_arr)->delete();
        return $m3_result->toJson();
    }

    $book_ids = $request->input('book_ids', '');
    if($book_ids == '') {
      $m3_result->status = 1;
      $m3_result->message = '书籍ID为空';
      return $m3_result->toJson();
    }

    // 未登录
    $bk_cart = $request->cookie('bk_cart');
    $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());
    foreach ($bk_cart_arr as $key => $value) {
      $index = strpos($value, ':');
      $book_id = substr($value, 0, $index);
      // 存在, 删除
      if(in_array($book_id, $book_ids_arr)) {
        array_splice($bk_cart_arr, $key, 1);
        continue;
      }
    }
    $m3_result->status = 0;
    $m3_result->message = '删除成功';
    return response($m3_result->toJson())->withCookie('bk_cart', implode(',', $bk_cart_arr));
  }
}
