<?php

namespace App\Http\Controllers;

class AdController extends Controller
{
    public function index()
    {
        return view('backend.module', ['header' => '動態文字廣告管理', 'module' => 'Ad']);
    }

    public function create()
    {
        $view = [
            'action' => '/admin/ad',
            'modal_header' => '新增動態廣告文字',
            'modal_body' => [
                [
                    'label' => '動態廣告文字',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                    // 'value'=>'請輸入文字'
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }
}
