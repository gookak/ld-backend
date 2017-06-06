@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        ข้อมูลรายการสั่งของ
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
                <a class="btn btn-sm btn-primary" href="/purchaseorder/create">
                    <i class="ace-icon fa fa-plus align-top bigger-125"></i>
                    เพิ่ม
                </a>
            </div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive">
            <table id="tb-purchase-order" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>หมายเลข</th>
                        <th>ผู้สั่ง</th>
                        <th>ผู้ขาย</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseorders as $purchaseorder)
                    <tr>
                        <td class="center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-warning" href="/purchaseorder/{{ $purchaseorder->id }}/edit" >
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </a>
                                {{-- <a class="btn btn-xs btn-info" href="/order/{{ $order->id }}" >
                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                </a> --}}
                                {{-- <a class="btn btn-xs btn-warning btn-edit" data-id="{{ $order->id }}">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </a> --}}
                            </div>
                        </td>
                        <td>{{ $purchaseorder->code }}</td>
                        <td>{{ $purchaseorder->admin->name }}</td>
                        <td>{{ $purchaseorder->vendor->name }}</td>
                        <td>
                            @if( $purchaseorder->purchasestatus->name == 'create' )
                            <span class="text-primary ">{{ $purchaseorder->purchasestatus->detail }}</span>
                            @elseif( $purchaseorder->purchasestatus->name == 'ongoing' )
                            <span class="text-warning orange">{{ $purchaseorder->purchasestatus->detail }}</span>
                            @elseif( $purchaseorder->purchasestatus->name == 'completed' )
                            <span class="text-success green">{{ $purchaseorder->purchasestatus->detail }}</span>
                            @endif
                        </td>
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

        var tb_purchase_order = $('#tb-purchase-order')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    //"bAutoWidth": true,
                    "aoColumns": [
                    {"bSortable": false, "width": "10%", "targets": 0},
                    null, null, null, null
                    ],
                    "aaSorting": [],
                    //"sScrollY": "200px",
                    //"bPaginate": false,
                    //"sScrollX": "100%",
                    "sScrollXInner": "100%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
                    "iDisplayLength": 25,
                    "language": {
                        "url": "{{ asset('themes/ace-master/assets/js/datatables/i18n/Thai.lang') }}"
                    }
                });

        // //delete
        // $(".btn-del").click(function () {
        //     var r = confirm("คุณต้องการลบรายการที่เลือก");
        //     if (r === true) {
        //         var id = $(this).data("id");
        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             url:'/user/' + id, 
        //             type: 'POST',
        //             data: { '_method': 'delete'},
        //         })
        //         .done(function(result) {
        //             console.log(result);
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