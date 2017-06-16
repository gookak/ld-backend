@extends('layouts/main')

@section('content')
{{-- <div class="page-header">
    <h1>
        รายละเอียดคำสั่งซื้อ
    </h1>
</div> --}}

<div class="row">
    <div class="clearfix">
        <div id="msgErrorArea"></div>
    </div> 
</div>

<div id="orderdetail">
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-large">
                    <h3 class="widget-title">
                        {{-- <i class="ace-icon fa fa-leaf green"></i> --}}
                        หมายเลขรายการขาย {{ $order->code }}
                    </h3>

                    <div class="widget-toolbar no-border invoice-info">
                    {{-- <span class="invoice-info-label">เลขที่:</span>
                    <span class="red">#{{ $order->code }}</span> --}}

                    <br>
                    <span class="invoice-info-label">วันที่:</span>
                    <span class="blue">{{ $order->created_at ? $order->created_at->addYears(543)->format('d/m/Y') : null }}</span>
                </div>

                {{-- hidden-480 --}}
                <div class="widget-toolbar">
                    <a href="/order/{{ $order->id }}/pdf" target="_blank">
                        <i class="ace-icon fa fa-print"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-24">
                    <div class="row">
                        @if($transportstatus)
                        <ul class="steps">
                            @foreach($transportstatus as $index => $transport)
                            <li data-step="{{ $transport->id }}" class="{{ $order->transportstatus_id == $transport->id ? 'active' : null }}">
                                <span class="step">{{ ++$index }}</span>
                                <span class="title">{{ $transport->detail }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <div class="space"></div>

                    @if( $order->orderdetail )
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="center">รหัส</th>
                                <th>ชื่อ</th>
                                <th class="hidden-xs">รายละเอียด</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $order->orderdetail as $od )
                            <tr>
                                <td class="center">{{ $od->product->code }}</td>
                                <td>{{ $od->product->name }}</td>
                                <td class="hidden-xs">{{ $od->product->detail }}</td>
                                <td>{{ number_format( $od->price, 2 ) }}</td>
                                <td>{{ $od->number }}</td>
                                <td>{{ number_format( $od->price * $od->number, 2 ) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    <div class="hr hr8 hr-double hr-dotted"></div>

                    {{-- <div class="row">
                        <div class="col-xs-5 col-xs-offset-7 pull-right">
                            <h4 class="pull-right">
                                รวมทั้งหมด :
                                <span class="red">{{ $order->sumprice }}</span>
                            </h4>
                        </div>
                    </div> --}}

                    <div class="space"></div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="widget-box">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <ul class="list-unstyled">
                                            <li class="text-primary"><b>ที่อยู่สำหรับจัดส่งสินค้า</b></li>
                                            <li>{{ $order->address }}</li>
                                            <li class="text-primary"><b>รหัสพัสดุ</b></li>
                                            <li>{{ $order->emscode ? $order->emscode : '-' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="widget-box">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <ul class="list-unstyled">
                                            <li class="text-primary"><b>สรุปยอกการสั่งซื้อ</b></li>
                                            <li>จำนวนสินค้าทั้งหมด <b class="text-primary">{{ $order->sumnumber }}</b> ชิ้น</li>
                                            <li>มูลค่าสินค้า <b class="text-primary">{{ number_format( $order->sumprice , 2 ) }}</b> บาท</li>
                                            {{-- <li>ค่าธรรมเนียม <b class="text-primary">{{ number_format( $order->fee , 2 ) }}</b> บาท</li>
                                            <li>ส่วนลด <b class="text-primary">{{ number_format( $order->promotion , 2 ) }}</b> บาท</li> --}}
                                            <li>ยอดสุทธิ <b class="text-primary">{{ number_format( $order->totalprice , 2 ) }}</b> บาท</li>
                                            <li><b class="text-primary">{{ $order->totalpricestring }}</b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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