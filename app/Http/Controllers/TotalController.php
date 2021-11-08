<?php

namespace App\Http\Controllers;

class TotalController extends Controller
{
    public function index()
    {
        return view('backend.module', ['header' => '進站人數管理', 'module' => 'Total']);
    }
}
