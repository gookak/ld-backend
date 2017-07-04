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
            <div id="msgErrorArea">
                @include('layouts.errors')
            </div>
        </div>

        <form id="productForm" class="form-horizontal" role="form" action="{{ $form_action }}" method="POST">
            {{-- {{ csrf_field() }} --}}

            {{ $mode=='edit'? method_field('PUT') : null }}

            <div class="form-group">
                <label class="col-sm-2 control-label">ประเภทสินค้า</label>
                <div class="col-sm-5">
                    {{ Form::select('category_id', ['' => 'กรุณาเลือก'] + $categoryList, $product->category_id, array('class' => 'form-control')) }}
                </div>
            </div>

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

            {{-- <div class="form-group">
                <label class="col-sm-2 control-label">จำนวน</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="balance" placeholder="" value="{{ $product->balance }}" />
                </div>
            </div> --}}

            <div class="form-group">
                <label class="col-sm-2 control-label">จำนวน (แจ้งเตือน)</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="balance_check" placeholder="" value="{{ $product->balance_check }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">คำอธิบาย</label>
                <div class="col-sm-5">
                    <textarea class="form-control" rows="5" name="detail" placeholder="">{{ $product->detail }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">รูปภาพ</label>
                <div class="col-sm-5">
                    <button type="button" class="btn btn-primary btn-sm fa fa-plus fa-x" data-toggle="modal" data-target="#modal-add-image"> เพิ่มรูป</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-add-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">เพิ่มรูป</h4>
                                </div>
                                <div class="modal-body">
                                    <ul id="model-ul-image" class="ace-thumbnails clearfix">
                                        {{-- <li>
                                            <img width="150" height="150" alt="150x150" src="">
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-2">
                    @if ( $product->productImage )
                    <ul id="ul-image" class="ace-thumbnails clearfix">
                        @foreach($product->productImage as $productImage)
                        <li data-fileid="{{ $productImage->fileupload->id }}">
                            <img width="150" height="150" alt="150x150" src="{{ asset(env('FILE_URL').$productImage->fileupload->filename )}}">
                            <div class="tools tools-bottom">
                                <a class="a-del"><i class="ace-icon fa fa-times red"></i></a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
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

        // Delete image
        $(document).on("click", ".a-del", function () {
            //console.log($(this).parent().parent());
            $(this).parent().parent().remove();
        });

        // Add Image
        $(document).on("click", "#model-ul-image li", function () {
            //console.log($(this).data('fileid'));
            //console.log($(this).html());
            var st = '<li data-fileid="'+ $(this).data('fileid') +'">'
            + $(this).html()
            + '<div class="tools tools-bottom"><a class="a-del"><i class="ace-icon fa fa-times red"></i></a></div></li>';
            // console.log(st);
            $('#ul-image').append(st);

            $('#modal-add-image').modal('hide');
        });

        // Bootstrap Modal
        $('#modal-add-image').on('show.bs.modal', function (e) {
            $('#model-ul-image').html('');
            $.ajax({
                url: '/apigetfileupload',
                type: 'GET',
            }).done(function(result) {
                //console.log(result);
                if (result.status === 200) {
                    $.each( result.rs, function( key, value ) {
                        //console.log( value.id + " : " + value.url );
                        $('#model-ul-image').append('<li data-fileid="'+ value.id +'"><img width="150" height="150" alt="150x150" src="'+value.url+'"></li>');
                    });
                }
            });
        });
        // End Bootstrap Modal


        $('#productForm').bootstrapValidator({
            framework: 'bootstrap',
            fields: {
                category_id: {
                    validators: {
                        notEmpty: true
                    }
                },
                name: {
                    validators: {
                        notEmpty: true
                    }
                },
                price: {
                    validators: {
                        notEmpty: true,
                        numeric: {
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                balance_check: {
                    validators: {
                        notEmpty: true,
                        integer:true
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
            // console.log($form.serializeArray());

            //var p = JSON.stringify($form.serializeObject());
            // console.log(p);

            // var formdata = $form.serializeObject();
            // var p = {};
            // $(formdata).each(function(index, obj){
            //     console.log(obj.name + " : "+ obj.value);
            //     //p[obj.name] = obj.value;

            // });
            
            var p = {};
            var formdata = $form.serializeArray();
            $.each(formdata, function(i, field){
                //console.log(field.name + ":" + field.value + " ");
                p[field.name] = field.value;
            });

            var pi = [];
            $("#ul-image li").each(function () {
                pi.push({
                    fileupload_id: $(this).data('fileid')
                });
            });

            var alldata = {};
            var mode = "{{ $mode=='edit'? 'edit' : null }}";
            if(mode=='edit') {
                alldata['_method'] = 'PUT';
            }
            alldata['product'] = p;
            alldata['product_image'] = pi;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $form.attr('action'), 
                type: 'POST',
                data: alldata,
                dataType: 'JSON',
            })
            .done(function(result) {
                //console.log(result);
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