<?php

namespace App\Http\Controllers;

use App\Models\Bottom;
use App\Models\Title;
use App\Models\Total;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//使用這3張表
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    //把原本取得取消$useTitle = Title::where('sh', 1)->first(); ---->不用了
    // protected $useTitle = '01B01.jpg';

    protected $view = []; //要先有不然會出現不能對未定義的物件執行

    // protected宣告成員這邊是不能有其他方法的，所以要寫方法要 __construct 或是set
    public function __construct()
    {
        $this->view['title'] = Title::where('sh', 1)->first();
        //total只有一筆資料 要->total這個欄位
        $this->view['total'] = Total::first()->total;
        $this->view['bottom'] = Bottom::first()->bottom;

        // 把驗證session Total+1 從Controller 移到這邊，然後因為不再web 定義的route中，所以不會跑Illuminate\Session\Middleware\StartSession::class, ==>改kerrnel
        // if (session()->has('visiter')) {
        //     $total = Total::first();
        //     ++$total->total;
        //     // +完再存
        //     $total->save();
        //     // 原本controller 有寫total的方法
        //     // 有session 了 重整會找不到這個變數，所以變通開啟原本的$this->view['total'] = Total::first()->total; 先抓一次，如果session在不做下面Total+1
        //     $this->view['total'] = $total->total;
        //     // 兩個用法都可以
        //     // session(['visiter' => $total->total]);
        //     session()->put('visiter', $total->total);
        // }
        // $this->view['bottom'] = Bottom::first()->bottom;
    }
}
