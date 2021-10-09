<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{

    public function index() {
        $data['roles'] = Auth::user()->getRolesNames();
        return view('panel.index', $data);
    }

}
