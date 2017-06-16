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
            <div id="msgErrorArea"></div>
        </div>

        <div id="accordion" class="accordion-style1 panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;แก้ไขรายการสั่งซื้อ
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseOne">
                    <div class="panel-body">
                        <form id="orderForm" class="form-horizontal" role="form" action="{{ $form_action }}" method="POST">

                            {{ $mode=='edit'? method_field('PUT') : null }}

                            <div class="form-group">
                                <label class="col-sm-2 control-label">สถานะจัดส่ง</label>
                                <div class="col-sm-5">
                                    {{ Form::select('transportstatus_id', $transportstatusList, $order->transportstatus_id, array('class' => 'form-control')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">รหัสพัสดุ</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="emscode" placeholder="" value="{{ $order->emscode }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">วันที่ส่งสินค้า</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="send_at" placeholder="" value="{{ $order->send_at ? $order->send_at->addYears(543)->format('d/m/Y') : null }}"/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">วันที่เสร็จ</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="complete_at" placeholder="" value="{{ $order->complete_at ? $order->complete_at->addYears(543)->format('d/m/Y') : null }}" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group clearfix ">
                                <div class="col-sm-5 col-xs-offset-2">
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        บันทึก
                                    </button>
                                    <a class="btn btn-sm btn-default" href="/order">
                                        <i class="ace-icon fa fa-reply bigger-110"></i>
                                        ยกเลิก
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;รายละเอียดรายการขาย
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseTwo">
                    <div class="panel-body">
                        <div id="orderdetail"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->


@section('tag-footer')

<script type="text/javascript">
    $(function () {

        $("#orderdetail").load("/order/{{ $order->id }} #orderdetail" );

        $('.datepicker').datepicker({language:'th-th',format:'dd/mm/yyyy'})
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });


        $('#orderForm').bootstrapValidator({
            framework: 'bootstrap',
            fields: {
                transportstatus_id: {
                    validators: {
                        notEmpty: true
                    }
                }
                // ,
                // emscode: {
                //     validators: {
                //         notEmpty: true
                //     }
                // }
            }
        }).on("success.form.bv", function (e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // console.log($form);
            // console.log($form.attr('action'));
            // console.log($form.serialize());

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $form.attr('action'), 
                type: 'POST',
                data: $form.serialize(),
            })
            .done(function(result) {
                // console.log(result);
                if (result.status === 200) {
                    window.location = "/order";
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