@extends('layouts_pdf/main')

@section('content')

{{-- {{ $orders->count() }} --}}

<table boder="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="center"><b>{{ $report->name }}</b></td>
        </tr>
        <tr>
            {{-- <td class="center">ประจำเดือน {{ $report->month }} ปี {{ $report->year }} </td> --}}
            {{-- <td class="center">ระหว่างวันที่ {{ $report->start_date }} - {{ $report->end_date }} </td> --}}
            <td class="center">{{ $report->text_header }}</td>
        </tr>
    </tbody>
</table>

<table class="one" cellspacing="0">
    <thead>
        <tr>
            <th>ประเภทสินค้า/รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th colspan="2">จำนวน (ชิ้น)</th>
            <th>รวมยอดขาย (บาท)</th>
        </tr>
    </thead>
    <tbody>
        @php 
        $totalnumber = 0; 
        $totalprice = 0; 
        @endphp

        @if( $orders->count() > 0 )
        @foreach( $categorys as $category )
        <tr>
            <td colspan="5" class="color-bg-01"><b>{{ $category->name}}</b></td>
        </tr>
        @foreach( $orders as $order )
        @if($category->id == $order->category_id)
        <tr>
            <td>&nbsp;&nbsp; {{ $order->code }}</td>
            <td>{{ $order->product_name }}</td>
            <td colspan="2" class="center">{{ $order->sumnumber }}</td>
            <td class="center">{{ number_format( $order->sumprice, 2 ) }}</td>
        </tr>
        @php 
        $totalnumber += $order->sumnumber;
        $totalprice += $order->sumprice;
        @endphp
        @endif
        @endforeach
        @endforeach
        @else
        <tr>
            <td colspan="5" class="center"><b>ไม่พบข้อมูล</b></td>
        </tr>
        @endif

    </tbody>
    <tfoot>
        @if( $orders->count() > 0 )
        <tr>
            <td colspan="2" class="center">{{ $report->totalpricestring }}</td>
            <td class="right">รวม</td>
            <td class="center">{{ $totalnumber }}</td>
            <td class="center">{{ number_format( $totalprice , 2 ) }}</td>
        </tr>
        @endif
    </tfoot>
</table>

@endsection