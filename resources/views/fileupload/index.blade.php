@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        อัพโหลดรูปสินค้า
        {{-- <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Static &amp; Dynamic Tables
        </small> --}}
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="clearfix">
            <div id="msgErrorArea">
                @include('layouts.errors')
            </div>
        </div>

        <div class="clearfix">
            <div class="pull-left tableTools-container">
                <form class="form-inline" role="form" action="/fileupload" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" class="form-control" name="images[]" multiple placeholder=""/>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Upload</button>
            </form>
        </div>
    </div>
    @if ($fileuploads)
    <ul id="show-image" class="ace-thumbnails clearfix">
        @foreach ($fileuploads as $fileupload)
        <li>
            <a href="{{ asset(env('FILE_URL').$fileupload->filename )}}" data-rel="colorbox" class="cboxElement">
                <img width="150" height="150" alt="150x150" src="{{ asset(env('FILE_URL').$fileupload->filename )}}">
                <div class="text">
                    <div class="inner">Zoom</div>
                </div>
            </a>
            <div class="tools tools-bottom">
                <a class="btn-del" data-id="{{ $fileupload->id }}"><i class="ace-icon fa fa-times red"></i></a>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
    <!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->


@section('tag-footer')

<script type="text/javascript">
    $(function () {

        //delete
        $(".btn-del").click(function () {
            var r = confirm("คุณต้องการลบรายการที่เลือก");
            if (r === true) {
                var id = $(this).data("id");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/fileupload/' + id, 
                    type: 'POST'
                }).done(function(result) {
                    //console.log(result);
                    if (result.status === 200) {
                        location.reload(true);
                    }else {
                        showMsgError("#msgErrorArea", result.msgerror);
                    }
                }).fail(function () {
                    showMsgError("#msgErrorArea", "ส่งข้อมูล AJAX ผิดพลาด");
                });
            }
        });
        //end delete


        //colorbox
        var $overflow = '';
        var colorbox_params = {
            rel: 'colorbox',
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="ace-icon fa fa-arrow-left"></i>',
            next:'<i class="ace-icon fa fa-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                $overflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = $overflow;
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        };

        $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);

        $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon

        $(document).one('ajaxloadstart.page', function(e) {
            $('#colorbox, #cboxOverlay').remove();
        });
        //end colorbox

    });
</script>

@stop

@stop