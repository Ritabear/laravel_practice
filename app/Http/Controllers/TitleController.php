<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Title::all();
        $cols = ['網站標題', '替代文字', '顯示', '刪除', '操作'];
        $rows = [];

        foreach ($all as $a) {
            $tmp = [
                [
                    'tag' => 'img',
                    'src' => $a->img,
                    'style' => 'width:300px;height:30px',
                ],
                [
                    'tag' => '',
                    'text' => $a->text,
                ],
                [
                    'tag' => 'button',
                    'type' => 'button',
                    'btn_color' => 'btn-success',
                    'action' => 'show',
                    'id' => $a->id,
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
                [
                    'tag' => 'button',
                    'type' => 'button',
                    'btn_color' => 'btn-info',
                    'action' => 'edit',
                    'id' => $a->id,
                    'text' => '編輯',
                ],
            ];
            $rows[] = $tmp;
        }
        // dd($rows);

        $view = [
            'header' => '網站標題管理',
            'module' => 'Title',
            'cols' => $cols,
            'rows' => $rows,
        ];

        return view('backend.module', $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = [
            'action' => '/admin/title',
            'modal_header' => '新增網站標題',
            'modal_body' => [
                [
                    'label' => '標題區圖片',
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'img',
                ],
                [
                    'label' => '標題區替代文字',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                ],
            ],
        ];
        // return view('modals.base_modal', ['modal_header' => '新增網站標題']);
        return view('modals.base_modal', $view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // 如果有檔案，以及在驗證一次(是合法的)
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            // // 取得檔名
            // $filename = $request->file('img')->getClientOriginalName();
            // $request->file('img')->storeAs('public', $filename);
            // $text = $request->input('text');
            // // 要存 $title是資料模型
            // $title = new Title();
            // // 告訴這個欄位放這個
            // $title->img = $filename;
            // $title->text = $text;
            // 簡易版
            $title = new Title();
            // 不要存錯位置~
            $request->file('img')->storeAs('public', $request->file('img')->getClientOriginalName());
            $title->img = $request->file('img')->getClientOriginalName();
            $title->text = $request->input('text');
            $title->save();
        }
        // 有沒有存成功回去
        return redirect('/admin/title'); //419 :csrf 保護
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = Title::find($id);
        $view = [
            //告訴位置確定 +id
            'action' => '/admin/title/'.$id,
            // 告訴方法
            'method' => 'patch',
            'modal_header' => '編輯網站標題資料',
            'modal_body' => [
                [
                    'label' => '目前標題區圖片',
                    'tag' => 'img',
                    'src' => $title->img,
                    'style' => 'width:300px;height:30px',
                ],
                [
                    'label' => '更換標題區圖片',
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'img',
                ],
                [
                    'label' => '標題區替代文字',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' => $title->text,
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = Title::find($id);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $request->file('img')->storeAs('public', $request->file('img')->getClientOriginalName());
            $title->img = $request->file('img')->getClientOriginalName();
        }
        //有變更再更新
        if ($title->text != $request->input('text')) {
            $title->text = $request->input('text');
        }
        $title->save();

        // return '更新資料';
        return redirect('/admin/title');
    }

    /**
     * 改變資料的顯示狀態 ** * 這樣寫，空格向下自動+ *.
     */
    public function display($id)
    {
        // 要顯示資料，所以我們先撈資料
        $title = Title::find($id);
        if ($title->sh == 1) {
            $title->sh = 0;
            //至少有一筆是顯示: 找到顯示隱藏(0)的第一筆
            //原本是隱藏變顯示要找隱藏中第一筆變顯示
            $findDefault = Title::where('sh', 0)->first();
            $findDefault->sh = 1;
            // $title->save();
            $findDefault->save();

            // 表示這筆資料就是要被設為顯示的圖片
            $img = $findDefault->img;
        } else {
            //隱藏設為顯示
            $title->sh = 1;
            $findShow = Title::where('sh', 1)->first();
            $findShow->sh = 0;

            // $title->save();
            $findShow->save();
            $img = $title->img;
        }
        $title->save();
        //現在要回傳 只要點選那顆變顯示其他都隱藏
        return $img;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //有條件方式刪 所以這不是delete
        Title::destroy($id);
    }
}
