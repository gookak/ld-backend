@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        ข้อมูลสินค้าขาดสต๊อก
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

        {{-- <div class="clearfix">
            <div class="panel panel-primary">
                <div class="panel-heading">ค้นหา</div>
                <div class="panel-body">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">ประเภทสินค้า : </label>
                            <div class="col-sm-5">
                                {!! Form::select('category-filter', ['' => 'ทั้งหมด'] + $categoryList, null, array('class' => 'form-control input-filter')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">ชื่อ : </label>
                            <div class="col-sm-5">
                                <input type="text" id="name-filter" class="form-control" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> --}}

        <div class="clearfix">
            <div class="pull-left tableTools-container">
                <a class="btn btn-sm btn-primary" target="_blank" href="/productoutofstock/pdf">
                    <i class="ace-icon fa fa-check align-top bigger-125"></i>
                    พิมพ์
                </a>
            </div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive">
            <table id="tb-product" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ประเภทสินค้า</th>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อ</th>
                        <th>จำนวนคงเหลือ (แจ้งเตือน)</th>
                        <th>จำนวนคงเหลือ</th>
                        {{-- <th class="hidden">category_id</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if( $products )
                    @foreach($products as $product)
                    <tr>      
                        <td>{{ $product->category->name }}</td>                 
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="center">{{ $product->balance_check }}</td>
                        <td class="center">{{ $product->balance }}</td>
                    </tr>
                    @endforeach
                    @endif
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

        // var tb_product = $('#tb-product')
        //         //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        //         .DataTable({
        //             //"bAutoWidth": true,
        //             // "searching": false,
        //             "sDom": '<"top"i>rt<"bottom"lp><"clear">',
        //             "aoColumns": [
        //             {"bSortable": false, "targets": 0},
        //             null, null, null, null
        //             ],
        //             "aaSorting": [],
        //             //"sScrollY": "200px",
        //             //"bPaginate": false,
        //             //"sScrollX": "100%",
        //             "sScrollXInner": "100%",
        //             //"bScrollCollapse": true,
        //             //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
        //             //you may want to wrap the table inside a "div.dataTables_borderWrap" element
        //             "iDisplayLength": 25,
        //             "language": {
        //                 "url": "{{ asset('themes/ace-master/assets/js/datatables/i18n/Thai.lang') }}"
        //             }
        //         });

        // //filter
        // $('form').on('keyup keypress', function(e) {
        //     var keyCode = e.keyCode || e.which;
        //     if (keyCode === 13) { 
        //         e.preventDefault();
        //         return false;
        //     }
        // });

        // $('#name-filter').keyup(function () {
        //     tb_product.column(2).search($(this).val()).draw();
        // });

        // $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        //     var v = $('[name=category-filter]').val();
        //     var dataCol = data[6] || 0;
        //     if ((v === '') || (v === dataCol)) {
        //         return true;
        //     }
        //     return false;
        // });

        // $('.input-filter').change(function () {
        //     tb_product.draw();
        // });
        // //end filter

        // //delete
        // $(".btn-del").click(function () {
        //     var r = confirm("คุณต้องการลบรายการที่เลือก");
        //     if (r === true) {
        //         var id = $(this).data("id");
        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             url:'/product/' + id, 
        //             type: 'POST',
        //             data: { '_method': 'delete'},
        //         })
        //         .done(function(result) {
        //             // console.log(result);
        //             if (result.status === 200) {
        //                 location.reload(true);
        //             }else {
        //                 showMsgError("#msgErrorArea", result.msgerror);
        //             }
        //         }).fail(function () {
        //             showMsgError("#msgErrorArea", "ส่งข้อมูล AJAX ผิดพลาด");
        //         });
        //     }
        // });
        // //end delete


    });
</script>

@stop

@stop