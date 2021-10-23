<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(15);
        return view('products.index', compact('products'));
    }

    public function panelIndex()
    {
        $data['products'] = Product::select(['id', 'category_id', 'title', 'description'])->orderBy('id', 'DESC')->paginate(10);
        return view('panel.products.list', $data);
    }

    public function create()
    {
        $data['categories'] = Category::getCategories();
        return view('panel.products.create', $data);
    }

    public function store(AddProductRequest $req)
    {

        $product = new Product();
        $product->category_id = $req->category_id;
        $product->title = $req->title;
        $product->alias = $req->alias;
        $product->description = $req->desc;
        $product->amount = isset($req->amount) ? $req->amount : 0;
        $product->save();

        if ($req->hasFile('images')) $this->addProductPhoto($req->file('images'), $product->id);

        return ['success' => 'Товар добавлен.', 'route' => route('panel_products_list')];
    }

    public function update(UpdateProductRequest $req)
    {
        $product = Product::find($req->id);
        $product->category_id = $req->category_id;
        $product->title = $req->title;
        $product->alias = $req->alias;
        $product->description = $req->desc;
        $product->amount = isset($req->amount) ? $req->amount : 0;
        $product->save();

        $old_images = explode(",", $req->old_images);

        if ($product->photos->count()) {
            foreach ($product->photos as $photo) {

                if (in_array($photo->id, $old_images)) continue;

                if (Storage::exists('public/' . $photo->image)) {
                    Storage::disk('public')->delete($photo->image);
                    $photo->delete();
                }

            }
        }

        if ($req->hasFile('images')) $this->addProductPhoto($req->file('images'), $product->id);

        return ['success' => 'Изменения сохранены.', 'route' => route('panel_product_show', $product->id)];
    }

    public function show($alias)
    {
        $product = Product::where('alias', $alias)->get()->first();
        if (!isset($product)) return redirect()->route('products_list')->withErrors('Товар не найден.');
        return view('products.show', compact('product'));
    }

    public function panelShow($id)
    {
        $data['categories'] = Category::getCategories();
        $data['product'] = Product::findOrFail($id);

        return view('panel.products.show', $data);
    }

    public function delete(Request $req)
    {
        $product = Product::find($req->id);
        if ($product->photos->count()) {
            foreach ($product->photos as $photo) {
                if (Storage::exists('public/' . $photo->image)) {
                    Storage::disk('public')->delete($photo->image);
                    $photo->delete();
                }
            }
        }

        $product->delete();

        return ['success' => 'Товар удален.', 'route' => route('panel_products_list')];
    }

    private function addProductPhoto($images, $id)
    {
        foreach ($images as $image) {
            $path = $this->saveFile($image, 'products/images');

            $product_photo = new ProductPhoto();
            $product_photo->product_id = $id;
            $product_photo->image = $path;
            $product_photo->save();
        }
    }


    private function saveFile($item, $path_save = 'uploads')
    {
        return $item->store($path_save, 'public');
    }

}
