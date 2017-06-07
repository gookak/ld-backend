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

<div id="purchaseorderdetail">
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-large">
                    <h3 class="widget-title">
                        {{-- <i class="ace-icon fa fa-leaf green"></i> --}}
                        #{{ $purchaseorder->code }}
                    </h3>

                    <div class="widget-toolbar no-border invoice-info">
                        <br>
                        <span class="invoice-info-label">วันที่สั่งของ:</span>
                        <span class="blue">{{ $purchaseorder->order_at ? $purchaseorder->order_at->addYears(543)->format('d/m/Y') : null }}</span>
                    </div>

                    <div class="widget-toolbar hidden-480">
                        <a href="/purchaseorder/{{ $purchaseorder->id }}/pdf" target="_blank">
                            <i class="ace-icon fa fa-print"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-24">
                        <div class="row">
                            @if($purchasestatuss)
                            <ul class="steps">
                                @foreach($purchasestatuss as $index => $purchasestatus)
                                <li data-step="{{ $purchasestatus->id }}" class="{{ $purchaseorder->purchase_status_id == $purchasestatus->id ? 'active' : null }}">
                                    <span class="step">{{ ++$index }}</span>
                                    <span class="title">{{ $purchasestatus->detail }}</span>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>

                        <div class="space"></div>

                        <div class="hr hr8 hr-double hr-dotted"></div>

                        <div class="space"></div>


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="widget-box">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled">
                                                <li class="text-primary"><b>ข้อมูลร้านค้า (ผู้ขาย)</b></li>
                                                <li>{{ $purchaseorder->vendor->name }}</li>
                                                <li>{{ $purchaseorder->vendor->address }}</li>
                                                <li>เบอร์โทร {{ $purchaseorder->vendor->tel ? $purchaseorder->vendor->tel : '-' }}</li>
                                                <li>FAX. {{ $purchaseorder->vendor->fax ? $purchaseorder->vendor->fax : '-' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-xs-6">
                                <div class="widget-box">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled">
                                                <li class="text-primary"><b>ข้อมูลผู้ติดต่อ</b></li>
                                                <li>ร้าน L&D.COM</li>
                                                <li>บิ๊กซีบางพลี ชั้น 2 เลขที่ 89 หมู่ 9 ถนนเทพารักษ์ กม.13 ถนนเทพารักษ์ ต.บางพลีใหญ่ อ.บางพลี จ.สมุทรปราการ 10540</li>
                                                <li>ผู้ติดต่อ {{ $purchaseorder->admin->name }}</li>
                                                <li>เบอร์โทร {{ $purchaseorder->admin->tel ? $purchaseorder->admin->tel : '-' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="space"></div>

                        <div class="hr hr8 hr-double hr-dotted"></div>

                        <div class="space"></div>

                        @if( $purchaseorder->purchaseorderdetail )
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="center" style="width: 5%;">ลำดับ</th>
                                    <th class="center">ชื่อ</th>
                                    <th class="center" style="width: 10%;">จำนวน (ชิ้น)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $totalnumber = 0;
                                @endphp
                                @foreach( $purchaseorder->purchaseorderdetail as $index => $pod )
                                <tr>
                                    <td class="center">{{ ++$index }}</td>
                                    <td>{{ $pod->name }}</td>
                                    <td class="center">{{ $pod->number }}</td>
                                </tr>
                                @php 
                                $totalnumber += $pod->number;
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><b class="pull-right">รวม</b></td>
                                    <td class="center"><b>{{ $totalnumber }}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                        @endif

                        <div class="space"></div>

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