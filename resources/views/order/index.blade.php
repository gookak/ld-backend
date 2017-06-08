@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        ข้อมูลรายการสั่งซื้อ
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
            <div class="panel panel-primary">
                <div class="panel-heading">ค้นหา</div>
                <div class="panel-body">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">หมายเลขคำสั่งซื้อ : </label>
                            <div class="col-sm-5">
                                <input type="text" id="code-filter" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">สถานะจัดส่ง : </label>
                            <div class="col-sm-5">
                                {!! Form::select('transportstatus-filter', ['' => 'ทั้งหมด'] + $transportstatusList, null, array('class' => 'form-control input-filter')) !!}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive">
            <table id="tb-order" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>หมายเลขคำสั่งซื้อ</th>
                        <th>สั่งเมื่อวันที่</th>
                        <th>ยอดสุทธิ</th>
                        <th>สถานะจัดส่ง</th>
                        <th class="hidden">transportstatus_id</th>
                        <th>รหัสพัสดุ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-warning" href="/order/{{ $order->id }}/edit" >
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
                        <td>
                            {{-- <a href="/order/{{ $order->id }}">{{ $order->code }}</a> --}}
                            {{ $order->code }}
                        </td>
                        <td>{{ $order->created_at ? $order->created_at->addYears(543)->format('d/m/Y') : null }}</td>
                        <td>{{ number_format( $order->totalprice , 2 ) }}</td>
                        <td>
                            @if( $order->transportstatus->name == 'ongoing' )
                            <span class="text-primary ">{{ $order->transportstatus->detail }}</span>
                            @elseif( $order->transportstatus->name == 'sending' )
                            <span class="text-warning orange">{{ $order->transportstatus->detail }}</span>
                            @elseif( $order->transportstatus->name == 'completed' )
                            <span class="text-success green">{{ $order->transportstatus->detail }}</span>
                            @endif
                        </td>
                        <td class="hidden">{{ $order->transportstatus->id }}</td>
                        <td>{{ $order->emscode }}</td>
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

        var tb_order = $('#tb-order')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    //"bAutoWidth": true,
                    // "searching": false,
                    "sDom": '<"top"i>rt<"bottom"lp><"clear">',
                    "aoColumns": [
                    {"bSortable": false, "width": "10%", "targets": 0},
                    null, null, null, null, null, null
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

        //filter
        $('#code-filter').keyup(function () {
            tb_order.column(1).search($(this).val()).draw();
        });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            var v = $('[name=transportstatus-filter]').val();
            var dataCol = data[5] || 0;
            if ((v === '') || (v === dataCol)) {
                return true;
            }
            return false;
        });

        $('.input-filter').change(function () {
            tb_order.draw();
        });
        //end filter

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