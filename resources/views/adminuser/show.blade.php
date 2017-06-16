@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        รายละเอียดผู้ใช้งาน
    </h1>
</div>

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
                            &nbsp;ข้อมูลส่วนบุคคล
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseOne">
                    <div class="panel-body">
                        <div class="profile-user-info">

                            <div class="profile-info-row">
                                <div class="profile-info-name"> สิทธิ์ผู้ใช้งาน </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->role->detail }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> ชื่อ-นามสกุล </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->name }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> อีเมล์ </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->email }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> เบอร์ติดต่อ </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->tel }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> เพศ </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->gender }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> วันเกิด </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->birthday ? $adminuser->birthday->addYears(543)->format('d/m/Y') : null }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> ที่อยู่ </div>
                                <div class="profile-info-value">
                                    <span>{{ $adminuser->address }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group clearfix form-actions">
            <div class="col-sm-5 col-xs-offset-1">
                <a class="btn btn-sm btn-primary" href="/adminuser/{{ $adminuser->id }}/pdf" target="_blank">
                    <i class="ace-icon fa fa-print"></i>
                    พิมพ์
                </a>
                <a class="btn btn-sm btn-default" href="/adminuser">
                    <i class="ace-icon fa fa-reply bigger-110"></i>
                    ยกเลิก
                </a>
            </div>
        </div>

        <!-- PAGE CONTENT ENDS -->
    </div>
</div>


@section('tag-footer')

<script type="text/javascript">
    $(function () {


    });
</script>

@stop

@stop