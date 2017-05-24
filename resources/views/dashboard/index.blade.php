@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        หน้าแรก
        {{-- <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Static &amp; Dynamic Tables
        </small> --}}
    </h1>
</div><!-- /.page-header -->


<div class="row center">
    <div class="col-sm-3">
        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-money"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{{ number_format( $sumTotalPrice) }} บาท</span>
                <div class="infobox-content">ยอดขายประจำวัน</div>
            </div>

            {{-- <div class="badge badge-success">
                +32%
                <i class="ace-icon fa fa-arrow-up"></i>
            </div> --}}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="infobox infobox-orange2">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-gift"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{{ number_format($sumNumber) }} ชิ้น</span>
                <div class="infobox-content">จำนวนสินค้าที่ขายได้วันนี้</div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="infobox infobox-pink">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-shopping-cart"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{{ number_format($countOrder) }} รายการ</span>
                <div class="infobox-content">รายการสั่งซื้อวันนี้</div>
            </div>
            {{-- <div class="stat stat-important">4%</div> --}}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-users"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{{ number_format($countUser) }} คน</span>
                <div class="infobox-content">สมาชิกใหม่วันนี้</div>
            </div>

            {{-- <div class="stat stat-success">8%</div> --}}
        </div>
    </div>
</div>

<div class="hr hr32 hr-dotted"></div>

<div class="row">
    <div class="col-sm-6">
        <h3 class="header smaller lighter blue">รายการสั่งซื้อล่าสุดวันนี้</h3>
        <table class="table table-bordered table-striped">
            <thead class="thin-border-bottom">
                <tr>
                    <th><i class="ace-icon fa fa-caret-right blue">หมายเลขของคำสั่งซื้อ</th>
                    <th><i class="ace-icon fa fa-caret-right blue">สั่งเมื่อวันที่</th>
                    <th><i class="ace-icon fa fa-caret-right blue">ยอดสุทธิ</th>
                    <th><i class="ace-icon fa fa-caret-right blue">สถานะจัดส่ง</th>
                </tr>
            </thead>
            <tbody>
                @if($orderLasts)
                @foreach($orderLasts as $order)
                <tr>
                    <td><a href="/order/{{ $order->id }}" target="_blank">{{ $order->code }}</a></td>
                    <td>{{ $order->created_at }}</td>
                    <td><b class="green">{{ number_format( $order->totalprice , 2 ) }}</b></td>
                    <td>
                        @if($order->transportstatus->name == 'ongoing')
                        <span class="text-primary ">{{ $order->transportstatus->detail }}</span>
                        @elseif($order->transportstatus->name == 'sending')
                        <span class="text-warning orange">{{ $order->transportstatus->detail }}</span>
                        @elseif($order->transportstatus->name == 'completed')
                        <span class="text-success green">{{ $order->transportstatus->detail }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <a class="btn btn-xs btn-primary" href="/order" target="_blank">ดูทั้งหมด</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-sm-6">
        <h3 class="header smaller lighter blue">สินค้าขายดีวันนี้</h3>
        <table class="table table-bordered table-striped">
            <thead class="thin-border-bottom">
                <tr>
                    <th><i class="ace-icon fa fa-caret-right blue">รหัสสินค้า</th>
                    <th><i class="ace-icon fa fa-caret-right blue">ชื่อ</th>
                    <th><i class="ace-icon fa fa-caret-right blue">ราคาต่อชิ้น</th>
                    <th><i class="ace-icon fa fa-caret-right blue">จำนวนที่ขายได้ (ชิ้น)</th>
                </tr>
            </thead>
            <tbody>
                @if($productBases)
                @foreach($productBases as $productBase)
                <tr>
                    <td>{{ $productBase->code }}</td>
                    <td>{{ $productBase->name }}</td>
                    <td><b class="green">{{ number_format( $productBase->price , 2 ) }}</b></td>
                    <td>{{ $productBase->number }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <a class="btn btn-xs btn-primary" href="/product" target="_blank">ดูทั้งหมด</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

{{-- <div class="hr hr32 hr-dotted"></div>

<div class="row">
    <div class="col-sm-6">
        <h3 class="header smaller lighter blue">ยอดขายประจำวันแบ่งตามประเภทสินค้า</h3>
        <div id="product-balance"></div>
    </div>
</div> --}}






@section('tag-footer')

<script type="text/javascript">
    $(function () {


    });
</script>

@stop

@stop