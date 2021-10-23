<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{

    public function index()
    {
        $data['roles'] = Auth::user()->getRolesNames();
        return view('panel.index', $data);
    }

    public function getAlias(Request $req)
    {
        $data = [];
        foreach ($req->str as $key => $value) {
            $data[$key] = Str::slug($value, '-');
        }

        return $data;
    }

}
