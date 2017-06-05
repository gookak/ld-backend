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

        <form id="adminuserForm" class="form-horizontal" role="form" action="{{ $form_action }}" method="POST">

            {{ csrf_field() }}

            {{ $mode=='edit'? method_field('PUT') : null }}

            <div class="form-group">
                <label class="col-sm-2 control-label">สิทธิ์ผู้ใช้งาน</label>
                <div class="col-sm-5">
                    {{ Form::select('role_id', ['' => 'กรุณาเลือก'] + $roleList, $adminuser->role_id, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">ชื่อ-นามสกุล</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $adminuser->name }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">อีเมล์</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" name="email" placeholder="" value="{{ $adminuser->email }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">รหัสผ่าน</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="password" placeholder="" value="" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">เบอร์ติดต่อ</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="tel" placeholder="" value="{{ $adminuser->tel }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">เพศ</label>
                <div class="col-sm-5">
                    {{ Form::select('gender', ['' => 'กรุณาเลือก'] + $genderList, $adminuser->gender, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">วันเกิด</label>
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="text" class="form-control datepicker" name="birthday" placeholder="" value="{{ $adminuser->birthday ? $adminuser->birthday->addYears(543)->format('d/m/Y') : null }}"/>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">ที่อยู่</label>
                <div class="col-sm-5">
                    <textarea class="form-control" rows="5" name="address" placeholder="">{{ $adminuser->address }}</textarea>
                </div>
            </div>

            <div class="form-group clearfix form-actions">
                <div class="col-sm-5 col-xs-offset-2">
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        บันทึก
                    </button>
                    <a class="btn btn-sm btn-default" href="/adminuser">
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

        $('#adminuserForm').bootstrapValidator({
            framework: 'bootstrap',
            fields: {
                role_id: {
                    validators: {
                        notEmpty: true
                    }
                },
                name: {
                    validators: {
                        notEmpty: true
                    }
                },
                email: {
                    validators: {
                        notEmpty: true
                    }
                },
                password: {
                    validators: {
                        notEmpty: true
                    }
                }
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
                console.log(result);
                if (result.status === 200) {
                    // console.log('ไม่ error');
                    window.location = "/adminuser";
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