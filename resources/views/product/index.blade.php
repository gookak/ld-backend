@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        ข้อมูลสินค้า
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

        <div class="clearfix">
            <div class="pull-left tableTools-container">
                <a class="btn btn-sm btn-primary" href="/product/create">
                    <i class="ace-icon fa fa-plus align-top bigger-125"></i>
                    เพิ่ม
                </a>
            </div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive">
            <table id="tb-product" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>รหัสสินค้า</th>
                        <th>รูป</th>
                        <th>ชื่อ</th>
                        <th>ราคาต่อชิ้น</th>
                        <th>จำนวนคงเหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-danger btn-del" data-id="{{ $product->id }}">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </a>
                                <a class="btn btn-xs btn-warning" href="/product/{{ $product->id }}/edit" >
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </a>
                            </div>
                        </td>                        
                        <td>{{ $product->code }}</td>
                        <td>
                            @if(count($product->productImage) > 0)
                            <img width="80" height="80" alt="150x150" src="{{ asset(env('FILE_URL').$product->productImage[0]->fileupload->filename )}}">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format( $product->price , 2 ) }}</td>
                        <td>{{ $product->balance }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->


@section('tag-footer')

<script type="text/javascript">
    $(function () {

        //checkBoxAllMutiTablePerPage("#checkAll", ".check");

        var tb_product = $('#tb-product')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    //"bAutoWidth": true,
                    "aoColumns": [
                    {"bSortable": false, "targets": 0},
                    null, null, null, null, null
                    ],
                    "aaSorting": [],
                    //"sScrollY": "200px",
                    //"bPaginate": false,
                    //"sScrollX": "100%",
                    "sScrollXInner": "100%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
                    "iDisplayLength": 25
                });

        //delete
        $(".btn-del").click(function () {
            var r = confirm("คุณต้องการลบรายการที่เลือก");
            if (r === true) {
                var id = $(this).data("id");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/product/' + id, 
                    type: 'POST',
                    data: { '_method': 'delete'},
                })
                .done(function(result) {
                    // console.log(result);
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


    });
</script>

@stop

@stop