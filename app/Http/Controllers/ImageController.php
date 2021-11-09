<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $all = Image::all();
        $cols = ['校園映像圖片', '顯示', '刪除', '操作'];
        $rows = [];

        foreach ($all as $a) {
            $tmp = [
                [
                    'tag' => 'img',
                    'src' => $a->img,
                    'style' => 'width:100px;height:68px',
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

        $view = [
            'header' => '校園映像圖片管理',
            'module' => 'Image',
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
            'action' => '/admin/image',
            'modal_header' => '新增校園映像圖片',
            'modal_body' => [
                [
                    'label' => '校園映像圖片',
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'img',
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            //不是$title = new Title(); 差別??????????
            $img = new Image();
            $request->file('img')->storeAs('public', $request->file('img')->getClientOriginalName());

            $img->img = $request->file('img')->getClientOriginalName();
            $img->save();
        }

        return redirect('/admin/image'); //419 :csrf 保護
    }

    public function edit($id)
    {
        $image = Image::find($id);
        $view = [
            //告訴位置確定 +id
            'action' => '/admin/image/'.$id,
            'method' => 'patch',
            'modal_header' => '編輯網站標題資料',
            'modal_body' => [
                [
                    'label' => '目前圖片',
                    'tag' => 'img',
                    'src' => $image->img,
                    'style' => 'width:100px;height:68px',
                ],
                [
                    'label' => '更換校園映像圖片',
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'img',
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    public function update(Request $request, $id)
    {
        $image = Image::find($id);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $request->file('img')->storeAs('public', $request->file('img')->getClientOriginalName());
            $image->img = $request->file('img')->getClientOriginalName();
            $image->save();
        }

        return redirect('/admin/image');
    }

    /**
     * 改變資料的顯示狀態 ** * 這樣寫，空格向下自動+ *.
     */
    public function display($id)
    {
        // 要顯示資料，所以我們先撈資料
        $image = Image::find($id);
        $image->sh = ($image->sh + 1) % 2;
        $image->save();
    }

    public function destroy($id)
    {
        //有條件方式刪
        Image::destroy($id);
    }
}
