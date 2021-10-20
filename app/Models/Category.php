<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function validParent($id) {
        $ids = $this->getAllChildren($this->id);
        $ids[] = $this->id;
        return ! in_array($id, $ids);
    }

    public function getAllChildren($id) {
        $children = self::where('parent_id', $id)->with('subs')->get();
        $ids = [];
        foreach ($children as $child) {
            $ids[] = $child->id;

            if ($child->subs->count()) {
                $ids = array_merge($ids, $this->getAllChildren($child->id));
            }
        }
        return $ids;
    }

    public function getParentsNames() {
        $parents = collect([]);
        if ($this->parent) {
            $parent = $this->parent;
            while (!is_null($parent)) {
                $parents->push($parent);
                $parent = $parent->parent;
            }
            return $parents;
        } else {
            return $this->title;
        }
    }

    public static function getCategories()
    {
        $arr = self::orderBy('id')->get();
        return self::buildTree($arr, 0);
    }


    public static function buildTree($arr, $pid = 0)
    {
        $found = $arr->filter(function ($item) use ($pid) {
            return $item->parent_id == $pid;
        });

        foreach ($found as $key => $cat) {
            $sub = self::buildTree($arr, $cat->id);
            $cat->sub = $sub;
        }
        return $found;
    }

}
