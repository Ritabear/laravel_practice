<?php

namespace App\Http\Controllers;

class NewsController extends Controller
{
    public function index()
    {
        return view('backend.module', ['header' => '最新消息管理', 'module' => 'News']);
    }
}
