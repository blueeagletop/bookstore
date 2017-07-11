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

class IndexController extends Controller {

    public function getAllBook() {
        $books=Book::all();
        return view('index')->with('books',$books);
    }
}
