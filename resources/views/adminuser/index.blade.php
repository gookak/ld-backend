@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        ข้อมูลผู้ใช้งาน
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
                            <label class="col-sm-2 control-label">ชื่อ : </label>
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

                        <div class="form-group">
                            <label class="col-sm-2 control-label">สิทธิ์ผู้ใช้งาน : </label>
                            <div class="col-sm-5">
                                {!! Form::select('role-filter', ['' => 'ทั้งหมด'] + $roleList, null, array('class' => 'form-control input-filter')) !!}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <div class="pull-left tableTools-container">
                <a class="btn btn-sm btn-primary" href="/adminuser/create">
                    <i class="ace-icon fa fa-plus align-top bigger-125"></i>
                    เพิ่ม
                </a>
            </div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive">
            <table id="tb-adminuser" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>ชื่อ</th>
                        <th>อีเมล์</th>
                        <th>สิทธิ์ผู้ใช้งาน</th>
                        <th class="hidden">role_id</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adminusers as $adminuser)
                    <tr>
                        <td class="center">
                            <div class="btn-group">
                                <a class="btn btn-xs btn-danger btn-del" data-id="{{ $adminuser->id }}">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </a>
                                <a class="btn btn-xs btn-warning" href="/adminuser/{{ $adminuser->id }}/edit" >
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{ $adminuser->name }}</td>
                        <td>{{ $adminuser->email }}</td>
                        <td>{{ $adminuser->role->detail }}</td>
                        <td class="hidden">{{ $adminuser->role->id }}</td>
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

        var tb_adminuser = $('#tb-adminuser')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    //"bAutoWidth": true,
                    // "searching": false,
                    "sDom": '<"top"i>rt<"bottom"lp><"clear">',
                    "aoColumns": [
                    {"bSortable": false, "width": "10%", "targets": 0},
                    null, null, null, null
                    // {"width": "90%"}
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
            tb_adminuser.column(1).search($(this).val()).draw();
        });

        $('#email-filter').keyup(function () {
            tb_adminuser.column(2).search($(this).val()).draw();
        });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            var v = $('[name=role-filter]').val();
            var dataCol = data[4] || 0;
            if ((v === '') || (v === dataCol)) {
                return true;
            }
            return false;
        });

        $('.input-filter').change(function () {
            tb_adminuser.draw();
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
                    url:'/adminuser/' + id, 
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