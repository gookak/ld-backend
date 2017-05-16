@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        {{ $header_text }}
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
            <div id="msgErrorArea"></div>
        </div>

        <form id="productForm" class="form-horizontal" role="form" action="{{ $form_action }}" method="POST" enctype="multipart/form-data">

            {{ $mode=='edit'? method_field('PUT') : null }}

            <div class="form-group">
                <label class="col-sm-2 control-label">ชื่อ</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $product->name }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">ราคาขาย/บาท</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="price" placeholder="" value="{{ $product->price }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">จำนวน</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="balance" placeholder="" value="{{ $product->balance }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">คำอธิบาย</label>
                <div class="col-sm-5">
                    <textarea class="form-control" rows="5" name="detail" placeholder="">{{ $product->detail }}</textarea>
                </div>
            </div>

            {{-- <h4 class="header blue bolder smaller">รูปสินค้า</h4> --}}

            <div class="form-group">
                <label class="col-sm-2 control-label">รูปภาพ</label>
                <div class="col-sm-5">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-image">เพิ่มรูป</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-add-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="show-image"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-5 col-xs-offset-2">
                    <ul class="ace-thumbnails clearfix">
                        <li>
                            <a data-rel="colorbox" class="cboxElement">
                                <img width="150" height="150" alt="150x150" src="http://localhost:8000/storage/INvJ5aIlr3YOxoolHU7WGxOrhwliP5uMRHKC0nLW.jpeg">
                            </a>
                        </li>
                        <li>
                            <a data-rel="colorbox" class="cboxElement">
                                <img width="150" height="150" alt="150x150" src="http://localhost:8000/storage/INvJ5aIlr3YOxoolHU7WGxOrhwliP5uMRHKC0nLW.jpeg">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="form-group clearfix form-actions">
                <div class="col-sm-5 col-xs-offset-2">
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        บันทึก
                    </button>
                    <a class="btn btn-sm btn-default" href="/product">
                        <i class="ace-icon fa fa-reply bigger-110"></i>
                        ยกเลิก
                    </a>
                </div>
            </div>
        </form>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->


@section('tag-footer')

<script type="text/javascript">
    $(function () {

        $('#modal-add-image').on('show.bs.modal', function (e) {
            $( ".modal-body" ).load( "/fileupload #show-image");
        });

        $(document).on("select", ".li-image", function () {
            console.log("555");
        });





        $('#productForm').bootstrapValidator({
            framework: 'bootstrap',
            fields: {
                name: {
                    validators: {
                        notEmpty: true
                    }
                }
            }
        }).on("success.form.bv", function (e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // console.log($form);
            // console.log($form.attr('action'));
            // console.log($form.serialize());

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $form.attr('action'), 
                type: 'POST',
                data: $form.serialize(),
            })
            .done(function(result) {
                console.log(result);
                if (result.status === 200) {
                    window.location = "/product";
                }else {
                    showMsgError("#msgErrorArea", result.msgerror);
                }
            }).fail(function () {
                showMsgError("#msgErrorArea", "ส่งข้อมูล AJAX ผิดพลาด");
            });
        });

    });
</script>

@stop

@stop