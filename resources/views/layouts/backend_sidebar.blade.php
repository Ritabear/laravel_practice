<div class="menu col-3">
    <div class="list-group text-center">
        <div class="border-bottom my-2 p-1">後台管理</div>
        {{-- dblock會佔滿父空間 --}}
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/title"> 標題圖片管理</a>
        </div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/ad"> 動態文字廣告管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/image">校園映像圖片管理</a>
        </div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/mvim"> 動畫圖片管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/total">進站人數管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/bottom">頁尾版權管理</a>
        </div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/news">最新消息管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/admin">管理者管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/menu"> 選單管理</a></div>
    </div>
    {{-- 在module.blade有include 這檔案，所以在module帶值近來 --}}
    <div class="border text-center my-2">訪客人數:{{$total}}</div>
</div>
