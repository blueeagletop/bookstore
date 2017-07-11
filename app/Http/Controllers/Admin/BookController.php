<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Entity\Book;
use App\Entity\BookContent;
use App\Entity\BookImages;
use Illuminate\Http\Request;
use App\Models\M3Result;

class BookController extends Controller {

    public function toBook() {
        //return view('admin.book');
        $books = Book::all();
        foreach ($books as $book) {
            $book->category = Category::find($book->category_id);
        }

        return view('admin.book')->with('books', $books);
    }

    public function toBookInfo(Request $request) {
        $id = $request->input('id', '');

        $book = Book::find($id);
        $book->category = Category::find($book->category_id);

        $book_content = BookContent::where('book_id', $id)->first();
        $book_images = BookImages::where('book_id', $id)->get();



        return view('admin.book_info')->with('book', $book)
                        ->with('book_content', $book_content)
                        ->with('book_images', $book_images);
    }

    public function toBookAdd() {
        $categories = Category::whereNotNull('parent_id')->get();

        return view('admin.book_add')->with('categories', $categories);
    }

    public function toBookEdit(Request $request) {
        $id = $request->input('id', '');
        $book = Book::find($id);
        $book->category = Category::find($book->category_id);
        
        $book_content = BookContent::where('book_id', $id)->get();
        
        $book_images = BookImages::where('book_id', $id)->get();
        
        $categories = Category::whereNotNull('parent_id')->get();
//        return $book_content;
        
        return view('admin.book_edit')->with('book', $book)
                        ->with('book_content', $book_content)
                        ->with('book_images', $book_images)
                        ->with('categories', $categories);
    }
    
    /*     * ******************Service******************** */

    public function bookAdd(Request $request) {
        $title = $request->input('title', '');
        $summary = $request->input('summary', '');
        $price = $request->input('price', '');
        $category_id = $request->input('category_id', '');
        $preview = $request->input('preview', '');
        $content = $request->input('content', '');

        $preview1 = $request->input('preview1', '');
        $preview2 = $request->input('preview2', '');
        $preview3 = $request->input('preview3', '');
        $preview4 = $request->input('preview4', '');
        $preview5 = $request->input('preview5', '');

        $book = new Book;
        $book->summary = $summary;
        $book->price = $price;
        $book->category_id = $category_id;
        $book->preview = $preview;
        $book->title = $title;
        $book->save();

        $book_content = new BookContent;
        $book_content->book_id = $book->id;
        $book_content->content = $content;
        $book_content->save();

        if ($preview1 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview1;
            $book_images->image_no = 1;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview2 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview2;
            $book_images->image_no = 2;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview3 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview3;
            $book_images->image_no = 3;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview4 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview4;
            $book_images->image_no = 4;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview5 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview5;
            $book_images->image_no = 5;
            $book_images->book_id = $book->id;
            $book_images->save();
        }

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function bookEdit(Request $request) {
        $id = $request->input('id', '');
        $book = Book::find($id);

        $title = $request->input('title', '');
        $summary = $request->input('summary', '');
        $price = $request->input('price', '');
        $category_id = $request->input('category_id', '');
        $preview = $request->input('preview', '');
        $content = $request->input('content', '');

        $preview1 = $request->input('preview1', '');
        $preview2 = $request->input('preview2', '');
        $preview3 = $request->input('preview3', '');
        $preview4 = $request->input('preview4', '');
        $preview5 = $request->input('preview5', '');

        $book = new Book;
        $book->summary = $summary;
        $book->price = $price;
        $book->category_id = $category_id;
        $book->preview = $preview;
        $book->title = $title;
        $book->save();

        $book_content = new BookContent;
        $book_content->book_id = $book->id;
        $book_content->content = $content;
        $book_content->save();

        if ($preview1 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview1;
            $book_images->image_no = 1;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview2 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview2;
            $book_images->image_no = 2;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview3 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview3;
            $book_images->image_no = 3;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview4 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview4;
            $book_images->image_no = 4;
            $book_images->book_id = $book->id;
            $book_images->save();
        }
        if ($preview5 != '') {
            $book_images = new BookImages;
            $book_images->image_path = $preview5;
            $book_images->image_no = 5;
            $book_images->book_id = $book->id;
            $book_images->save();
        }

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    public function bookDel(Request $request) {
            $id = $request->input('id', '');
    Book::find($id)->delete();

    $m3_result = new M3Result;
    $m3_result->status = 0;
    $m3_result->message = '删除成功';

    return $m3_result->toJson();
    }
}
