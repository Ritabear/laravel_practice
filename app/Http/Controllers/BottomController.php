<?php

namespace App\Http\Controllers;

use App\Models\Bottom;
use Illuminate\Http\Request;

class BottomController extends Controller
{
    public function index()
    {
        //只有一筆
        $bottom = Bottom::first();
        $cols = ['頁尾版權文字'];
        $rows = [
            //3維改2維
            [
                //第0筆
                'tag' => '',
                'text' => $bottom->bottom,
            ],
            [
                //第1筆資料
                'tag' => 'button',
                'type' => 'button',
                'btn_color' => 'btn-info',
                'action' => 'edit',
                'id' => $bottom->id,
                'text' => '編輯',
            ],
        ];

        $this->view['header'] = '頁尾版權管理';
        $this->view['module'] = 'Bottom';
        $this->view['cols'] = $cols;
        $this->view['rows'] = $rows;

        return view('backend.module', $this->view);
    }

    public function edit($id)
    {
        $bottom = Bottom::find($id);
        $view = [
            //告訴位置確定 +id
            'action' => '/admin/bottom/'.$id,
            'method' => 'patch',
            'modal_header' => '頁尾版權文字',
            'modal_body' => [
                [
                    'label' => '頁尾版權',
                    'tag' => 'input',
                    //類別只能輸入text的格式
                    'type' => 'text',
                    'name' => 'bottom',
                    'value' => $bottom->bottom,
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    public function update(Request $request, $id)
    {
        $bottom = Bottom::find($id);

        if ($bottom->text != $request->input('bottom')) {
            $bottom->bottom = $request->input('bottom');
            $bottom->save();
        }

        return redirect('/admin/bottom');
    }
}
