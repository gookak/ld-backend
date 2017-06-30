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

            <div id="findby-detail">
                <div id="findby">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">เงื่อนไข</label>

                        <div class="col-sm-5">
                            <select name="findby" class="form-control input-filter">
                                {{-- <option value="" selected>กรุณาเลือก</option> --}}
                                <option value="date">วันที่</option>
                                <option value="year-month">ปี/เดือน</option>
                                <option value="date-between">ระหว่างวันที่</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="findby-date">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">วันที่</label>

                        <div class="col-sm-10">
                            <span class="input-icon input-icon-right">
                                <input type="text" class="form-control datepicker" name="date"/>
                                <i class="ace-icon fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div id="findby-year-month">
                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">ปี/เดือน</label>

                        <div class="col-sm-2">
                            {!! Form::select('year', ['' => 'กรุณาเลือก'] + $yearList, null, array('class' => 'form-control input-filter')) !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::select('month', ['' => 'กรุณาเลือก'] + $monthList, null, array('class' => 'form-control input-filter')) !!}
                        </div>
                    </div>
                </div>

                <div id="findby-date-between">
                    <div class="form-group">
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
        </div>

    </form>

    <!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->


@section('tag-footer')

<script type="text/javascript">
    $(function () {

        //function
        function checkReportUrl($val){
            switch($val) {
                case '/report/salesbycategory':
                case '/report/salesbyproduct':
                $('#findby').show();
                checkFindby($('[name=findby]').val());
                break;
                default:
                $('#findby').hide();
                hideFindbyAll ();
                break;
            }
        }

        function hideFindbyAll (){
            $('#findby-date').hide();
            $('#findby-year-month').hide();
            $('#findby-date-between').hide();
        }

        function checkFindby($val){
            switch($val) {
                case 'date':
                $('#findby-date').show();
                $('#findby-year-month').hide();
                $('#findby-date-between').hide();
                break;
                case 'year-month':
                $('#findby-date').hide();
                $('#findby-year-month').show();
                $('#findby-date-between').hide();
                break;
                case 'date-between':
                $('#findby-date').hide();
                $('#findby-year-month').hide();
                $('#findby-date-between').show();
                break;
                default:
                hideFindbyAll ();
                break;
            }
        }

        //load
        hideFindbyAll ();
        checkReportUrl($("[name=report_url]").val());
        
        //change
        $("[name=report_url]").change(function() {
            // hideFindbyAll ();
            checkReportUrl($(this).val());
        });

        $("[name=findby]").change(function() {
            checkFindby($(this).val());
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