<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function index()
    {
        return view('backend.module', ['header' => '選單管理', 'module' => 'Menu']);
    }
}
