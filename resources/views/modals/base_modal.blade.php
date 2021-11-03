<!-- Modal 基本的東西 -->
<div class="modal fade" id="baseModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        {{-- form >>{{ $action }}   method=沒支援patch 所以在Controller更改 --}}
        {{-- multipart/form-data 上傳圖片，要把新增的東西都得到  PS.form表單要把處存等都包含進去 --}}
        <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="w-100">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- 網站標題 --}}
                    <h5 class="modal-title" id="ModalCenter">{{ $modal_header }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    {{-- 作方法的判斷patch --}}
                    @isset($method)
                        @method($method)
                    @endisset
                    <table class="m-auto">
                        {{-- <tr>
                            //刻這個版面可以每一個controller 一個，但更進階就是重複的只要一個，可以用別的方式控制，例如include進來
                            <td>標題圖片</td>
                             //td中增加 input:file
                            <td><input type="file" name="img" id=""></td>  搬到input.blade.php
                            <td>@include('layouts.input')   可以用[]帶參數傳遞</td>
                            <td> @include('layouts.input',['type'=>'file','name'=>'img']) </td>
                        </tr>
                        <tr>
                            <td>標題區替代文字:</td>
                            <td><input type="text" name="text" id=""></td>
                        </tr> --}}

                        {{-- EP5 把變數從web.php >>TitleController 這邊判斷有沒有變數&做甚麼 --}}
                        @isset($modal_body)
                            @foreach ($modal_body as $row)
                                <tr>
                                    <td class='text-right'>{{ $row['label'] }}</td>
                                    <td>
                                        @switch($row['tag'])
                                            @case('input')
                                                @include("layouts.input",$row)
                                            @break
                                            @case('textarea')
                                                @include("layouts.textarea",$row)
                                            @break
                                            @case('img')
                                                @include('layouts.img',$row)
                                            @break
                                            @case('embed')
                                                @include("layouts.embed",$row)
                                            @break
                                            @default
                                                {{ $row['text'] }}
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                </div>
                </table>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">取消</button>
                    <button type="submit" class="btn btn-primary">儲存</button>
                </div>
            </div>
        </form>
    </div>
</div>
