@extends('layouts/main')

@section('content')

{{-- <div class="page-header">
    <h1>
        {{ $header_text }}
    </h1>
</div> --}}

<div class="row">
    <div class="clearfix">
        <div id="msgErrorArea"></div>
    </div> 
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="widget-title smaller">
                    {{-- <i class="ace-icon fa fa-check-square-o bigger-110"></i> --}}
                    ข้อมูลส่วนบุคคล
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info">

                        {{-- <ul class="list-unstyled">
                            <li>{{ $user->firstname }} {{ $user->lastname }}</li>
                            <li>{{ $user->email }}</li>
                            <li>{{ $user->tel }}</li>
                            <li><a href="#" class="pink">แก้ไข</a></li>
                        </ul> --}}

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

                        {{-- <div class="profile-info-row">
                            <div class="profile-info-name">  </div>
                            <div class="profile-info-value">
                                <span><a href="#" class="pink">แก้ไข</a></span>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>

        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="widget-title smaller">
                    {{-- <i class="ace-icon fa fa-check-square-o bigger-110"></i> --}}
                    ที่อยู่
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        @if ( $user->address )
                        @foreach($user->address as $address)
                        <div class="col-xs-4">
                            <div class="widget-box">
                                {{-- <div class="widget-header widget-header-flat">
                                    <h4 class="widget-title">Lists</h4>
                                </div> --}}

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <ul class="list-unstyled">
                                            <li>{{ $address->fullname }}</li>
                                            <li>{{ $address->detail }}</li>
                                            <li>{{ $address->postcode }}</li>
                                            <li>{{ $address->tel }}</li>
                                            {{-- <li>
                                                <a href="#" class="pink">แก้ไข</a>
                                                <a href="#" class="pink">ลบ</a>
                                            </li> --}}
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

        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="widget-title smaller">
                    {{-- <i class="ace-icon fa fa-check-square-o bigger-110"></i> --}}
                    ประวัติการสั่งซื้อ
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
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
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->totalprice }}</td>
                                <td>
                                    @if($order->transportstatus->name == 'ongoing')
                                    <span class="text-primary ">{{ $order->transportstatus->detail }}</span>
                                    @elseif($order->transportstatus->name == 'sending')
                                    <span class="text-warning orange">{{ $order->transportstatus->detail }}</span>
                                    <br/><span>ส่งวันที่ {{ $order->send_at }}</span>
                                    <br/><span>รหัสพัสดุ {{ $order->emscode }}</span>
                                    @elseif($order->transportstatus->name == 'completed')
                                    <span class="text-success green">{{ $order->transportstatus->detail }}</span>
                                    <br/><span>วันที่ส่งเสร็จ {{ $order->complete_at }}</span>
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
</div>




@section('tag-footer')

<script type="text/javascript">
    $(function () {


    });
</script>

@stop

@stop