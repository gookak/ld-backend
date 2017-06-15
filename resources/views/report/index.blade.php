@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        รายงาน
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

        <form id="reportForm" class="form-horizontal" role="form" action="" method="POST" target="_blank">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="col-sm-2 control-label">รายงาน</label>
                <div class="col-sm-5">
                    {{ Form::select('report_url', ['' => 'กรุณาเลือก'] + $reportList, null, array('class' => 'form-control')) }}
                </div>
            </div>

            <div id="date-filter" class="form-group">
                <label class="col-sm-2 control-label no-padding-right">ตั้งแต่วันที่</label>

                <div class="col-sm-10">
                    <span class="input-icon input-icon-right">
                        <input type="text" class="form-control datepicker" name="start_date"/>
                        <i class="ace-icon fa fa-calendar bigger-110"></i>
                    </span>
                    ถึง
                    <span class="input-icon input-icon-right">
                        <input type="text" class="form-control datepicker" name="end_date"/>
                        <i class="ace-icon fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>

            <div class="form-group clearfix form-actions">
                <div class="col-sm-5 col-xs-offset-2">
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        พิมพ์
                    </button>
                    {{-- <a class="btn btn-sm btn-default" href="/report">
                        <i class="ace-icon fa fa-reply bigger-110"></i>
                        ยกเลิก
                    </a> --}}
                </div>
            </div>
        </form>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->


@section('tag-footer')

<script type="text/javascript">
    $(function () {

        $('#date-filter').hide();

        $( "[name=report_url]" ).change(function() {
            switch( $(this).val() ) {
                case '/report/salesbycategory':
                case '/report/salesbyproduct':
                $('#date-filter').show();
                break;
                default:
                $('#date-filter').hide();
            }
        });

        $('.datepicker').datepicker({language:'th-th',format:'dd/mm/yyyy'})
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        $('select[name=report_url]').change( function(){
            // console.log($(this).val());
            $('#reportForm').attr('action', $(this).val());
        });

        // $('#reportForm').bootstrapValidator({
        //     framework: 'bootstrap',
        //     fields: {
        //         report_url: {
        //             validators: {
        //                 notEmpty: true
        //             }
        //         }
        //         // ,
        //         // start_date: {
        //         //     validators: {
        //         //         notEmpty: true
        //         //     }
        //         // },
        //         // end_date: {
        //         //     validators: {
        //         //         notEmpty: true
        //         //     }
        //         // }
        //     }
        // });

    });
</script>

@stop

@stop