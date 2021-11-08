<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $all = Ad::all();
        $cols = ['動態文字廣告', '顯示', '刪除'];
        $rows = [];

        foreach ($all as $a) {
            $tmp = [
                // 欄位照順序設定tag ，對照button.blade.php的變數順序填入
                [
                    'tag' => '',
                    'text' => $a->text,
                    // 'text' => $a->$text, NO!
                ],
                [
                    'tag' => 'button',
                    'type' => 'button',
                    'btn_color' => 'btn-success',
                    'action' => 'show',
                    'id' => $a->id,
                    //之前在裡面(前端)判斷
                    'text' => ($a->sh == 1) ? '顯示' : '隱藏',
                ],
                [
                    'tag' => 'button',
                    'type' => 'button',
                    'btn_color' => 'btn-danger',
                    'action' => 'delete',
                    'id' => $a->id,
                    'text' => '刪除',
                ],
            ];
            $rows[] = $tmp;
        }

        //dd($rows);//不停try 寫出東西dd 中斷在這
        $view = [
            'header' => '動態廣告文字管理',
            'module' => 'Ad',
            'cols' => $cols,
            'rows' => $rows,
        ];

        return view('backend.module', $view);
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
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    public function store(Request $request)
    {
        //動態廣告沒有上傳圖片，所以上傳圖片相關的不需要了
        $ad = new Ad();
        $ad->text = $request->input('text');
        $ad->save();

        return redirect('/admin/ad'); //419 :csrf 保護
    }

    public function edit($id)
    {
        //從Ad 的model裡面撈資料
        $ad = Ad::find($id);
        $view = [
            //告訴位置確定 +id
            'action' => '/admin/ad/'.$id,
            'method' => 'patch',
            'modal_header' => '編輯動態廣告文字',
            'modal_body' => [
                [
                    'label' => '動態廣告文字',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' => $ad->text,
                ],
            ],
        ];
        // return view('modals.base_modal', ['modal_header' => '新增網站標題']);
        return view('modals.base_modal', $view);
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);
        //沒存資料問題
        //有變更再更新
        if ($ad->text != $request->input('text')) {
            $ad->text = $request->input('text');
            //不寫在外面，沒變更也不用再存了
            $ad->save();
        }

        return redirect('/admin/ad');
    }

    /**
     * 改變資料的顯示狀態 ** * 這樣寫，空格向下自動+ *.
     */
    public function display($id)
    {
        // 要顯示資料，所以我們先撈資料
        $ad = Ad::find($id);
        //只要考慮自己在01切換 EX: 1+1 % 2 =0
        $ad->sh = ($ad->sh + 1) % 2;
        $ad->save();
    }

    public function destroy($id)
    {
        //有條件方式刪
        Ad::destroy($id);
    }
}
