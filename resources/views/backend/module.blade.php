@extends("layouts.layout")

@section('main')
@include("layouts.backend_sidebar",['total'=>$total])
<div class="main col-9 p-0 d-flex flex-wrap align-items-start">
    <div class="col-8 border py-3 text-center">後臺管理區</div>
    <button class="col-4 btn btn-light border py-3 text-center">管理登出</button>
    <div class="border w-100 p-1" style="height: 500px;overflow:auto">
        <h5 class="text-center border-bottom py-3">
            @if ($module != 'Total' && $module != 'Bottom')
            <button class="btn btn-sm btn-primary float-left" id="addRow">新增</button>
            @endif
            {{ $header }}
        </h5>
        <table class="table border-none text-center">
            <tr>
                @isset($cols)
                @if($module != 'Total' && $module !='Bottom')
                @foreach ($cols as $col)
                <td width="{{ $col }}">{{ $col }}</td>
                @endforeach
                @endif
                @endisset
            </tr>
            @isset($rows)
            @if ($module != 'Total' && $module != 'Bottom')
            @foreach ($rows as $row)
            <tr>
                @foreach ($row as $item)
                {{-- @dd($item); --}}
                <td>
                    @switch($item['tag'])
                    @case('img')
                    @include('layouts.img',$item)
                    @break
                    @case('button')
                    @include('layouts.button',$item)
                    @break
                    @default
                    {{ $item['text'] }}
                    @endswitch
                </td>
                @endforeach
            </tr>
            @endforeach
            @else
            <tr>
                {{-- 如果$module != 'Total' && $module != 'Bottom' 這是Total 才有的 --}}
                <td>{{ $cols[0] }}</td>
                <td>{{ $rows[0]['text'] }}</td>
                <td>@include("layouts.button",$rows[1])</td>
            </tr>
            @endif
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
        @isset($menu_id)
        $.get("/modals/add{{ $module }}/{{ $menu_id }}", function(modal) {
            $("#modal").html(modal)
            $("#baseModal").modal("show")

            $("#baseModal").on("hidden.bs.modal", function() {
                $("#baseModal").modal("dispose")
                $("#modal").html("")
            })
        })
        @else
        $.get("/modals/add{{ $module }}", function(modal) {
            $("#modal").html(modal)
            $("#baseModal").modal("show")

            $("#baseModal").on("hidden.bs.modal", function() {
                $("#baseModal").modal("dispose")
                $("#modal").html("")
            })
        })
        @endif
    })

    $(".edit").on("click", function() {
        let id = $(this).data('id')
        $.get(`/modals/{{ strtolower($module) }}/${id}`, function(modal) {
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
        let _this = $(this)
        $.ajax({
            type: 'delete'
            , url: `{{ strtolower($module) }}/${id}`
            , success: function() {
                // location.reload() //重整頁面
                // _this預先存了變數，如果是裡面設$(this) 指的是function； parents往上找到要的第一個標籤 not parent
                _this.parents('tr').remove()

            }
        })
    })
    $(".show").on("click", function() {
        let id = $(this).data('id')
        let _this = $(this)
        $.ajax({
            //改顯示狀況是更新所以是patch
            type: 'patch'
            , url: `{{ strtolower($module) }}/sh/${id}`,
            // 這邊新增的原因:title變更顯示的時候，希望是單選，只顯示一個 點選.show後會去route->去TitleController display()回傳img
            @if($module == 'Title')
            success: function(img) {
                if (_this.text() == "顯示") {
                    //jqury 回呼函式
                    $(".show").each((idx, dom) => {
                        if ($(dom).text() == '隱藏') {
                            // 第一個設為顯示
                            $(dom).text("顯示")
                            //中斷迴圈
                            return false;
                        }
                    })
                    _this.text("隱藏")

                } else {
                    // 所有按鈕$(".show") 都改為隱藏
                    $(".show").text("隱藏")
                    _this.text("顯示")
                }
            }
            $(".header img").attr("src", "http://quiz01.com/storage/" + img)
            //除了title以外
            @else
            success: function() {
                if (_this.text() == "顯示") {
                    _this.text("隱藏")
                } else {
                    _this.text("顯示")
                }
            }
            @endif

        })
    })


    // 次選單按鈕點下可以跳轉到主選單的id區塊
    $(".sub").on("click", function() {
        let id = $(this).data("id")
        location.href = `/admin/submenu/${id}`
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
