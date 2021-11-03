@extends("laysouts.layout")

@section("main")
@include("laysouts.backend_sidebar")
<div class="main col-9 p-0 d-flex flex-wrap align-items-start">
    <div class="col-8 border py-3 text-center">後臺管理區</div>
    <button class="col-4 btn btn-light border py-3 text-center" >管理登出</button>
    <div class="border w-100 p-1" style="height: 500px;">
        <h5 class="text-center border-bottom py-3">
            <button class="btn btn-sm btn-primary float-left" id="addRow">新增</button>
            {{$header}}
        </h5>
        <table>
            <tr>
                <td width="">網站標題</td>
                <td width="">替代文字</td>
                <td width="10%">顯示</td>
                <td width="10%">刪除</td>
                <td width="10%">操作</td>
            </tr>
            <tr>
                <td>圖片</td>
                <td><input type="text"></td>
                <td><button class="btn btn-success btn-sm"></button> 顯示</td>
                <td><button class="btn btn-danger btn-sm"></button> 刪除</td>
                <td><button class="btn btn-info btn-sm"></button> 編輯</td>
            </tr>
        </table>
    </div>
</div>

@endsection

@section("script")
<script>
    $("#addRow").on("click", function() {
        $.get("/modals/add{{ $module }}", function(modal) {
            $("#modal").html(modal)
            $("#baseModal").modal("show")

            $("#baseModal").on("hidden.bs.modal", function() {
                $("#baseModal").modal("dispose")
                $("#modal").html("")
            })
        })
    })
</script>




@endsection

