<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Category;
use App\Entity\Book;
use App\Entity\BookContent;
use App\Entity\BookImages;
use App\Entity\CartItem;
use Log;

class BookController extends Controller {

    public function toCategory($value = '') {
        Log::info("进入书籍类别");//错误日志
        $categorys=Category::whereNull('parent_id')->get();
        return view('category')->with('categorys',$categorys);
    }
    public function toBook($category_id) {
        $books=Book::where('category_id',$category_id)->get();
        return view('book')->with('books',$books);
    }
    public function toBookContent(Request $request,$book_id) {
        $book=Book::find($book_id);
        $book_content=BookContent::where('book_id',$book_id)->first();
        $book_images=BookImages::where('book_id',$book_id)->get();
        
        $count=0;

    $member = $request->session()->get('member', '');
    if($member != '') {
      $cart_items = CartItem::where('member_id', $member->id)->get();

      foreach ($cart_items as $cart_item) {
        if($cart_item->book_id == $book_id) {
          $count = $cart_item->count;
          break;
        }
      }
    } else {
      $bk_cart = $request->cookie('bk_cart');
      $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());

      foreach ($bk_cart_arr as $value) {   // 一定要传引用
        $index = strpos($value, ':');
        if(substr($value, 0, $index) == $book_id) {
          $count = (int) substr($value, $index+1);
          break;
        }
      }
    }
        
        
        return view('book_content')->with('book',$book)
                ->with('book_content',$book_content)
                ->with('book_images',$book_images)
                ->with('count',$count);
    }
}
