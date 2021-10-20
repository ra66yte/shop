<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class CategoryController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::select(['id', 'parent_id', 'title', 'description'])->get();
        return view('categories.index', $data);
    }

    public function panelIndex()
    {
        $data['categories'] = Category::select(['id', 'parent_id', 'title', 'description'])->orderBy('id', 'DESC')->paginate(10);
        return view('panel.categories.list', $data);
    }

    public function show($id)
    {
        $data['category'] = Category::find($id);
        if (empty($data['category'])) redirect()->route('panel_cat_list');
        return view('categories.show', $data);
    }

    public function panelShow($id)
    {
        $data['category'] = Category::findOrFail($id);
        $data['categories'] = Category::getCategories();

        return view('panel.categories.show', $data);
    }

    /*public function existsCategoryByName(Request $req) {
        $data['category'] = Category::where('id', '!=', $req->id)->where('title', $req->title)->exists();
        if ($data['category']){
            return true;
        }
        return false;
    }*/

    public function create()
    {
        $data['categories'] = Category::getCategories();
        return view('panel.categories.create', $data);
    }

    public function store(addCategoryRequest $req)
    {

        $category = new Category();
        $category->parent_id = ($req->parent_id == null) ? 0 : $req->parent_id;
        $category->title = $req->title;
        $category->alias = $req->alias;
        $category->description = $req->desc;
        $category->save();

        return redirect()->route('panel_cat_list')->withSuccess('Категория добавлена!');

    }

    public function update(UpdateCategoryRequest $req)
    {
        $category = Category::find($req->id);
        $category->parent_id = ($req->parent_id == null) ? 0 : $req->parent_id;
        $category->title = $req->title;
        $category->alias = $req->alias;
        $category->description = $req->desc;
        $category->save();

        return ['parent' => (isset($category->parent) ? $category->parent->title : '-'),
                'title' => $category->title,
                'alias' => $category->alias,
                'description' => $category->description];
    }

    public function delete(Request $req)
    {
        Category::find($req->id)->delete();
        return ['success' => 'Категория удалена', 'route' => route('panel_cat_list')];
    }


}
