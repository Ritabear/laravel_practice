<?php

namespace App\Http\Controllers;

use App\Models\Total;
use Illuminate\Http\Request;

class TotalController extends Controller
{
    public function index()
    {
        //只有一筆
        $total = Total::first();
        $cols = ['進站總人數'];
        $rows = [
            //3維改2維
            [
                //第0筆
                'tag' => '',
                'text' => $total->total,
            ],
            [
                //第1筆資料 &&編輯功能
                'tag' => 'button',
                'type' => 'button',
                'btn_color' => 'btn-info',
                'action' => 'edit',
                'id' => $total->id,
                'text' => '編輯',
            ],
        ];

        $this->view['header'] = '進站總人數管理';
        $this->view['module'] = 'Total';
        $this->view['cols'] = $cols;
        $this->view['rows'] = $rows;

        return view('backend.module', $this->view);
    }

    //route +controller +model 用好就可以用
    public function edit($id)
    {
        $total = Total::first();
        $view = [
            //告訴位置確定 +id
            'action' => '/admin/total/'.$id,
            'method' => 'patch',
            'modal_header' => '編輯網站進站總人數',
            'modal_body' => [
                [
                    'label' => '進站總人數',
                    'tag' => 'input',
                    //類別只能輸入數字的格式
                    'type' => 'number',
                    'name' => 'total',
                    'value' => $total->text,
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    public function update(Request $request, $id)
    {
        $total = Total::find($id);

        if ($total->text != $request->input('total')) {
            $total->total = $request->input('total');
            $total->save();
        }

        return redirect('/admin/total');
    }
}
