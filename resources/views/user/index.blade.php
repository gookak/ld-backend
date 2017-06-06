@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        ข้อมูลลูกค้า
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
                            <label class="col-sm-2 control-label">ชื่อ-นามสกุล : </label>
                            <div class="col-sm-5">
                                <input type="text" id="name-filter" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">อีเมล์ : </label>
                            <div class="col-sm-5">
                                <input type="text" id="email-filter" class="form-control" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive">
            <table id="tb-user" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>อีเมล์</th>
                        {{-- <th>สถานะใช้งาน</th> --}}
                        <th class="center">เข้าระบบฯครั้งล่าสุด</th>
                        <th class="center">ไม่ได้เข้าระบบฯ (วัน)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-danger btn-del" data-id="{{ $user->id }}">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </a>
                                <a class="btn btn-xs btn-info" href="/user/{{ $user->id }}" >
                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $user->use }}</td> --}}
                        <td class="center">
                            {{ $user->login_at ? $user->login_at->addYears(543)->format('d/m/Y') : null }}
                        </td>
                        <td class="center">
                            @if( $user->numdate >= 90 )
                            <b class="text-danger">{{ $user->numdate }}</b>
                            @else
                            {{ $user->numdate }}
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

        var tb_user = $('#tb-user')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    //"bAutoWidth": true,
                    // "searching": false,
                    "sDom": '<"top"i>rt<"bottom"lp><"clear">',
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

        //filter
        $('#name-filter').keyup(function () {
            tb_user.column(1).search($(this).val()).draw();
        });

        $('#email-filter').keyup(function () {
            tb_user.column(2).search($(this).val()).draw();
        });
        //end filter



        //delete
        $(".btn-del").click(function () {
            var r = confirm("คุณต้องการลบรายการที่เลือก");
            if (r === true) {
                var id = $(this).data("id");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/user/' + id, 
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