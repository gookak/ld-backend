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

        <form id="productForm" class="form-horizontal" role="form" action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{ $mode=='edit'? method_field('PUT') : null }}

            <div class="form-group">
                <label class="col-sm-2 control-label">ประเภทสินค้า</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="category_id" placeholder="" value="{{ $product->category_id }}" />
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

            @if ($mode=='create')
            <div class="form-group">
                <label class="col-sm-2 control-label">รูปภาพ</label>
                <div class="col-sm-5">
                    <input id="id-input-file-3" type="file" class="form-control" name="images[]" multiple/>
                </div>
            </div>
            @elseif ($mode=='edit')
            <div class="form-group">
                <label class="col-sm-2 control-label">รูปภาพ</label>
                <div class="col-sm-5">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-5 col-sm-offset-2">
                    @if ( $product->productImage )
                    <table id="tb-image" class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">ไฟล์</th>
                                {{-- <th class="center">เรียง</th> --}}
                                <th class="center">
                                    <button name="bt-addrow" data-type="img" type="button" class="btn btn-success btn-sm fa fa-plus fa-x"></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->productImage as $productImage)
                            <tr>
                                <td class="center">
                                    <img width="80" height="80" alt="150x150" src="{{ asset('storage/' . $productImage->filename )}}">
                                </td>
                                {{-- <td class="center">{{ $productImage->sort }}</td> --}}
                                <td class="center">
                                    <button name="bt-delrow" type="button" class="btn btn-danger btn-sm fa fa-trash-o"></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            @endif
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

        var tb_image = $('#tb-image').DataTable({
            sDom: '<"top"i>rt<"bottom"lp><"clear">',
            bPaginate: false, //row/page
            bFilter: false, //search
            bSort: false,
            responsive: true,
            columnDefs: [
            {"width": "5%", "targets": 1}
            ],
            createdRow: function (row, data, index) {
                $('td', row).eq(0).addClass('center');
                // $('td', row).eq(1).addClass('center').attr('contentEditable', true).attr('placeholder', 'กรอกข้อมูล');
                $('td', row).eq(2).addClass('center');
            }
            // ,
            // fnRowCallback: function (nRow, aData, iDisplayIndex) {
            //     $("td:first", nRow).html(iDisplayIndex + 1);
            //     return nRow;
            // }
        });

        $(document).on("click", "[name='bt-addrow']", function () {
            //var tbid = $(this).data("tableid");
            tb_image.row.add([
                '', '<button name="bt-delrow" data-tableid="tb-auditor" type="button" class="btn btn-danger btn-sm fa fa-trash-o"></button>'
                ]).draw();
        });

        $(document).on("click", "[name='bt-delrow']", function () {
            tb_image.row($(this).parents('tr')).remove().draw();
        });




        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small'
            //large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
                //Check an example below
                //or examples/file-upload.html
                return true;
            }*/
            /**,before_remove : function() {
                return true;
            }*/
            ,
            preview_error : function(filename, error_code) {
                // name of the file that failed
                // error_code values
                // 1 = 'FILE_LOAD_FAILED',
                // 2 = 'IMAGE_LOAD_FAILED',
                // 3 = 'THUMBNAIL_FAILED'
                // alert(error_code);
            }

        }).on('change', function(){
            // console.log($(this).data('ace_input_files'));
            // console.log($(this).data('ace_input_method'));
        });


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
                        notEmpty: true
                    }
                },
                balance: {
                    validators: {
                        notEmpty: true
                    }
                }
            }
        });
        // .on("success.form.bv", function (e) {
        //     // Prevent form submission
        //     e.preventDefault();
        //     // Get the form instance
        //     var $form = $(e.target);
        //     // console.log($form);
        //     // console.log($form.attr('action'));
        //     // console.log($form.serialize());

        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: $form.attr('action'), 
        //         type: 'POST',
        //         data: $form.serialize(),
        //     })
        //     .done(function(result) {
        //         console.log(result);
        //         if (result.status === 200) {
        //             window.location = "/product";
        //         }else {
        //             showMsgError("#msgErrorArea", result.msgerror);
        //         }
        //     }).fail(function () {
        //         showMsgError("#msgErrorArea", "ส่งข้อมูล AJAX ผิดพลาด");
        //     });
        // });

    });
</script>

@stop

@stop