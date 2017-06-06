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

        <form id="purchaseOrderForm" class="form-horizontal" role="form" action="{{ $form_action }}" method="POST">

            {{ $mode=='edit'? method_field('PUT') : null }}

            <div class="form-group">
                <label class="col-sm-2 control-label">หมายเลขสั่งของ</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="code" placeholder="" value="{{ $purchaseorder->code }}" disabled />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">ผู้ขาย</label>
                <div class="col-sm-5">
                    {{ Form::select('vendor_id', $vendorList, $purchaseorder->vendor_id, array('class' => 'form-control')) }}
                </div>
            </div>

            {{-- <div class="form-group">
                <label class="col-sm-2 control-label">ผู้สั่ง</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="admin_id" placeholder="" value="{{ $purchaseorder->admin_id }}" readonly />
                </div>
            </div> --}}

            <div class="form-group">
                <label class="col-sm-2 control-label">สถานะ</label>
                <div class="col-sm-5">
                    {{ Form::select('purchase_status_id', $purchasestatusList, $purchaseorder->purchase_status_id, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">วันที่สั่งของ</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="order_at" placeholder="" value="{{ $purchaseorder->order_at ? $purchaseorder->order_at->addYears(543)->format('d/m/Y') : null }}" />
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">วันที่รับของ</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="complete_at" placeholder="" value="{{ $purchaseorder->complete_at ? $purchaseorder->complete_at->addYears(543)->format('d/m/Y') : null }}" />
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">หมายเหตุ</label>
                <div class="col-sm-5">
                    <textarea class="form-control" rows="5" name="note" placeholder="">{{ $purchaseorder->note }}</textarea>
                </div>
            </div>

            <div class="space"></div>
            <div class="hr hr8 hr-double hr-dotted"></div>
            <div class="space"></div>

            <div class="row">



                <table class="table table-striped table-bordered table-hover" id="tb-detail">
                    <thead>
                        <tr>
                            <th class="center">ลำดับ</th>
                            <th>ชื่อ</th>
                            <th class="center">จำนวน</th>
                            <th class="text-center">
                                <button name="bt-addrow" data-tableid="tb-detail" type="button" class="btn btn-success btn-sm fa fa-plus fa-x"></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center"></td>
                            <td>Semi Mechanical Gaming Keyboard Rubber Dome รุ่น CENTAURUS KB-730</td>
                            <td>1</td>
                            <td class="text-center">
                                <button name="bt-delrow" data-tableid="tb-detail" type="button" class="btn btn-danger btn-sm fa fa-trash-o"></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>   

            <div class="form-group clearfix form-actions">
                <div class="col-sm-5 col-xs-offset-2">
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        บันทึก
                    </button>
                    <a class="btn btn-sm btn-default" href="/purchaseorder">
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

        $('.datepicker').datepicker({language:'th-th',format:'dd/mm/yyyy'})
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        var tb_detail = $('#tb-detail').DataTable({
            sDom: '<"top"i>rt<"bottom"lp><"clear">',
            bPaginate: false, //row/page
            bFilter: false, //search
            bSort: false,
            responsive: true,
            language: {
                url: "{{ asset('themes/ace-master/assets/js/datatables/i18n/Thai.lang') }}"
            },
            columnDefs: [
            // {"width": "5%", "targets": 0},
            // {"width": "15%", "targets": 1},
            // {"width": "5%", "targets": 3}
            ],
            createdRow: function (row, data, index) {
                $('td', row).eq(0).addClass('text-center');
                $('td', row).eq(1).addClass('name').attr('contentEditable', true).attr('placeholder', 'กรอกชื่ออย่างน้อย 3 ตัวอักษรเพื่อค้นหา');
                $('td', row).eq(2).addClass('text-center number').attr('contentEditable', true);
                $('td', row).eq(3).addClass('text-center');
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                $("td:first", nRow).html(iDisplayIndex + 1);
                return nRow;
            }
        });

        $(document).on("click", "[name='bt-addrow']", function () {
            tb_detail.row.add([
                '', '', '', '<button name="bt-delrow" data-tableid="tb-detail" type="button" class="btn btn-danger btn-sm fa fa-trash-o"></button>'
                ]).draw();
        });

        $(document).on("click", "[name='bt-delrow']", function () {
            tb_detail.row($(this).parents('tr')).remove().draw();
        });

        // $(document).on("focus", ".name", function () {
        //     if (!$(this).data("autocomplete")) { // If the autocomplete wasn't called yet:
        //         //console.log($(this).html());
        //         $(this).autocomplete({//   call it
        //             //source: availableTags
        //             source: function (request, response) {
        //                 console.log(request.term);
        //                 var getting = $.get("/apigetproductname/" + request.term );
        //                 getting.done(function (data) {
        //                     console.log(data);
        //                     response($.map(data.rs, function (v, i) {
        //                         return {
        //                             label: v.name,
        //                             value: v.name
        //                         };
        //                     }));
        //                 });
        //             }, 
        //             // minLength: 3,
        //             select: function (event, ui) {
        //                 //console.log(ui.item.empid);
        //                 // $(this).siblings(".empid").text(ui.item.empid);
        //                 //$(this).attr('data-empid', ui.item.empid);
        //             }
        //          //    change: function (event, ui) {
        //          //     console.log(ui.item.empid);
        //          //     $(this).attr('data-empid', ui.item.empid);
        //          // }
        //      });
        //     }
        // });





        $('#purchaseOrderForm').bootstrapValidator({
            framework: 'bootstrap',
            fields: {
                // code: {
                //     validators: {
                //         notEmpty: true
                //     }
                // }
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

            var po = {};
            var formdata = $form.serializeArray();
            $.each(formdata, function(i, field){
                //console.log(field.name + ":" + field.value + " ");
                po[field.name] = field.value;
            });

            var pod = [];
            $("#tb-detail tbody tr").each(function () {
                // console.log($(this).find('.name').html());
                pod.push({
                    name: $(this).find('.name').html(),
                    number: $(this).find('.number').html()
                });
            });

            var alldata = {};
            var mode = "{{ $mode=='edit'? 'edit' : null }}";
            if(mode=='edit') {
                alldata['_method'] = 'PUT';
            }
            alldata['purchase_order'] = po;
            alldata['purchase_order_detail'] = pod;
            // console.log(alldata);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $form.attr('action'), 
                type: 'POST',
                data: alldata,
                dataType: 'JSON',
            })
            .done(function(result) {
                // console.log(result);
                if (result.status === 200) {
                    window.location = "/purchaseorder";
                }else {
                    showMsgError("#msgErrorArea", result.msgerror);
                }
            }).fail(function () {
                showMsgError("#msgErrorArea", "ส่งข้อมูล AJAX ผิดพลาด");
            });

        });

    });
</script>

{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

@stop

@stop