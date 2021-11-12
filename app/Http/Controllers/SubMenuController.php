<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menu_id)
    {
        //因為只要找這個$menu_id，這個query條件選擇最後要get
        $all = SubMenu::where('menu_id', $menu_id)->get();
        $cols = ['次選單名稱', '次選單連結網址', '刪除', '操作', ''];
        $rows = [];

        foreach ($all as $a) {
            $tmp = [
                [
                    'tag' => '',
                    'text' => $a->text,
                ],
                [
                    'tag' => '',
                    'text' => $a->href,
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

        $this->view['header'] = '次選單管理';
        $this->view['module'] = 'SubMenu';
        $this->view['cols'] = $cols;
        $this->view['rows'] = $rows;
        $this->view['menu_id'] = $menu_id;

        // return view('backend.module', $view);
        return view('backend.module', $this->view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Route::get('/modals/addSubMenu/{menu_id}', [SubMenuController::class, 'create']); 新增
    public function create($menu_id)
    {
        $view = [
            'action' => '/admin/submenu/'.$menu_id,
            'modal_header' => '新增次選單',
            'modal_body' => [
                [
                    'label' => '次選單名稱',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                ],
                [
                    'label' => '次選單連結網址',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'href',
                ],
            ],
        ];

        return view('modals.base_modal', $view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    // Route::post('/submenu/{menu_id}', [SubMenuController::class, 'store']);
    //Request $request除了這些東西之外，我還要一個$menu_id(參數順序跟路由順序一樣)，route設置傳$menu_id給controller ->處理後給models
    //表單送過來的所有資料 $request
    public function store(Request $request, $menu_id)
    {
        $sub = new SubMenu();
        $sub->text = $request->input('text');
        $sub->href = $request->input('href');
        $sub->menu_id = $menu_id;
        $sub->save();

        return redirect('/admin/submenu/'.$menu_id);
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
        //編輯這邊知道這筆次選單資料是多少id，不用再傳一次$menu_id
        //之前edit的路由一樣就不用新增了
        $menu = SubMenu::find($id);
        $view = [
            'action' => '/admin/submenu/'.$id,
            'method' => 'PATCH',
            'modal_header' => '編輯主選單內容',
            'modal_body' => [
                [
                    'label' => '主選單名稱',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' => $menu->text,
                ],
                [
                    'label' => '主選單連結網址',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'href',
                    'value' => $menu->href,
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
        $sub = SubMenu::find($id);

        if ($sub->text != $request->input('text')) {
            $sub->text = $request->input('text');
        }
        if ($sub->href != $request->input('href')) {
            $sub->href = $request->input('href');
        }

        $sub->save();
        //這邊沒有傳參$menu_id，但是這個id在這裡$sub->menu_id
        return redirect('/admin/submenu'.$sub->menu_id);
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
        //自己的id ，不用$menu_id
        SubMenu::destroy($id);
    }
}
