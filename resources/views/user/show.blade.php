@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        รายละเอียดลูกค้า
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
                                <div class="profile-info-name"> ชื่อ-นามสกุล </div>
                                <div class="profile-info-value">
                                    <span>{{ $user->firstname }} {{ $user->lastname }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> อีเมล์ </div>
                                <div class="profile-info-value">
                                    <span>{{ $user->email }}</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> เบอร์ติดต่อ </div>
                                <div class="profile-info-value">
                                    <span>{{ $user->tel }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;ที่อยู่
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseTwo">
                    <div class="panel-body">
                        <div class="row">
                            @if ( $user->address )
                            @foreach($user->address as $address)
                            <div class="col-xs-4">
                                <div class="widget-box">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled">
                                                <li>{{ $address->fullname }}</li>
                                                <li>{{ $address->detail }}</li>
                                                <li>{{ $address->postcode }}</li>
                                                <li>{{ $address->tel }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;ประวัติการสั่งซื้อ
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseThree">
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                        หมายเลขของคำสั่งซื้อ
                                    </th>
                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                        สั่งเมื่อวันที่
                                    </th>
                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                        ยอดสุทธิ
                                    </th>
                                    <th>
                                        <i class="ace-icon fa fa-caret-right blue"></i>
                                        สถานะ
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if( $user->order )
                                @foreach( $user->order as $order )
                                <tr>
                                    <td>
                                        <a href="/order/{{ $order->id }}">{{ $order->code }}</a>
                                    </td>
                                    <td>{{ $order->created_at->addYears(543)->format('d/m/Y') }}</td>
                                    <td>{{ $order->totalprice }}</td>
                                    <td>
                                        @if($order->transportstatus->name == 'ongoing')
                                        <span class="text-primary ">{{ $order->transportstatus->detail }}</span>
                                        @elseif($order->transportstatus->name == 'sending')
                                        <span class="text-warning orange">{{ $order->transportstatus->detail }}</span>
                                        <br/><span>ส่งวันที่ {{ $order->send_at->addYears(543)->format('d/m/Y') }}</span>
                                        <br/><span>รหัสพัสดุ {{ $order->emscode }}</span>
                                        @elseif($order->transportstatus->name == 'completed')
                                        <span class="text-success green">{{ $order->transportstatus->detail }}</span>
                                        <br/><span>วันที่ส่งเสร็จ {{ $order->complete_at->addYears(543)->format('d/m/Y') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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