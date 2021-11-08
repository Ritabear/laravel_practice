@extends("layouts.layout")

@section('main')
@include("layouts.backend_sidebar")
<div class="main col-9 p-0 d-flex flex-wrap align-items-start">
    <div class="col-8 border py-3 text-center">後臺管理區</div>
    <button class="col-4 btn btn-light border py-3 text-center">管理登出</button>
    <div class="border w-100 p-1" style="height: 500px;">
        <h5 class="text-center border-bottom py-3">
            <button class="btn btn-sm btn-primary float-left" id="addRow">新增</button>
            {{ $header }}
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
                @isset($rows)
                @foreach ($rows as $row)
            </tr>
            <tr>
                {{-- <td> <img src="{{ asset('img/' . $row->img) }}" style="width: 300px; height:30px" alt=""> </td> --}}
                <td> <img src="{{ asset('storage/' . $row->img) }}" style="width: 300px; height:30px" alt=""> </td>

                <td>{{ $row->text }} </td>
                <td><button class="btn btn-success btn-sm show" data-id="{{ $row->id }}">
                        @if ($row->sh == 1)
                        顯示
                        @else
                        隱藏
                        @endif
                    </button> </td>
                <td><button class="btn btn-danger btn-sm delete" data-id="{{ $row->id }}">刪除</button> </td>
                <td><button class="btn btn-info btn-sm edit" data-id="{{ $row->id }}">編輯</button> </td>
            </tr>
            @endforeach

            @endisset
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

    $(".edit").on("click", function() {
        let id = $(this).data('id')
        // $.get(`/modals/{{ strtolower($module) }}/${id}`, function(modal) {
        $.get(`/modals/title/${id}`, function(modal) {
            $("#modal").html(modal)
            $("#baseModal").modal("show")

            $("#baseModal").on("hidden.bs.modal", function() {
                $("#baseModal").modal("dispose")
                $("#modal").html("")
            })
        })
    })

    // //jquery vs 原生ajax
    $(".delete").on("click", function() {
        let id = $(this).data('id')
        // let _this = $(this)
        $.ajax({
            type: 'delete',
            // 前面是/admin/~~/${id}
            // url: `{{ strtolower($module) }}/${id}`
            url: `/admin/title/${id}`
            , success: function() {
                location.reload() //重整頁面
                // _this預先存了變數，如果是裡面設$(this) 指的是function； parents往上找到要的第一個標籤
                // _this.parents('tr').remove()

            }
        })
    })
    $(".show").on("click", function() {
        let id = $(this).data('id')
        // let _this = $(this)
        $.ajax({
            //改顯示狀況是更新所以是patch
            type: 'patch',
            // , url: `{{ strtolower($module) }}/sh/${id}`,
            url: `/admin/title/sh/${id}`,
            // 這邊新增的原因:title變更顯示的時候，希望是單選，只顯示一個 點選.show後會去route->去TitleController display()回傳img
            success: function() {
                location.reload()
            }
        })
    })



    // @if($module == 'Title')
    // success: function(img) {
    //     if (_this.text() == "顯示") {
    //         //jqury 回呼函式
    //         $(".show").each((idx, dom) => {
    //             if ($(dom).text() == '隱藏') {
    //                 // 第一個設為顯示
    //                 $(dom).text("顯示")
    //                 //中斷迴圈
    //                 return false;
    //             }
    //         })
    //         _this.text("隱藏")

    //     } else {
    //         // 所有按鈕$(".show") 都改為隱藏
    //         $(".show").text("隱藏")
    //         _this.text("顯示")
    //     }
    // }
    // $(".header img").attr("src", "http://quiz01.com/storage/" + img)
    // //除了title以外
    // @else
    // success: function() {
    //     if (_this.text() == "顯示") {
    //         _this.text("隱藏")
    //     } else {
    //         _this.text("顯示")
    //     }
    // }
    // @endif

</script>
@endsection
