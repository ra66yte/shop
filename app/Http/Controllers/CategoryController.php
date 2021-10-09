<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index() {
        $data['categories'] = Category::select(['id', 'parent_id', 'title', 'description'])->get();
        return view('categories.index', $data);
    }

    public function panelIndex() {
        $data['categories'] = Category::select(['id', 'parent_id', 'title', 'description'])->get();
        return view('panel.category_list', $data);
    }

    public function show($id) {
        $data['category'] = Category::find($id);
        return view('categories.show', $data);
    }

    public function create() {
        return view('categories.create');
    }

    public function store(addCategoryRequest $req) {

//        $category = new Category();
//        $category->title = $req->title;
//        $category->description = $req->desc;
//        $category->save();
//
//        return redirect()->route('categories_list');
    }

    public function update(Request $req) {
        //dd($req->all());
        $category = Category::find($req->id);
        $category->title = $req->title;
        $category->description = $req->desc;
        $category->save();
        return $category;
    }

    public function delete(Request $req) {
        Category::find($req->id)->delete();
        return route('categories_list');
    }

}
