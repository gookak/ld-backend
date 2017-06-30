@extends('layouts_pdf/main')

@section('content')


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
        <th>ลำดับ</th>
        <th class="left">ประเภทสินค้า</th>
        <th>จำนวน (ชิ้น)</th>
        <th>รวมยอดขาย (บาท)</th>
    </tr>
</thead>
<tbody>
    @php 
    $i = 1;
    $totalnumber = 0; 
    $totalprice = 0; 
    @endphp

    @if( $orders->count() > 0 )
    @foreach( $orders as $order )
    <tr>
        <td class="center">{{ $i }}</td>
        <td>{{ $order->name }}</td>
        <td class="center">{{ $order->sumnumber }}</td>
        <td class="center">{{ number_format( $order->sumprice, 2 ) }}</td>
    </tr>
    @php 
    $i++;
    $totalnumber += $order->sumnumber;
    $totalprice += $order->sumprice;
    @endphp
    @endforeach
    @else
    <tr>
        <td colspan="4" class="center"><b>ไม่พบข้อมูล</b></td>
    </tr>
    @endif
</tbody>
<tfoot>
  <tr>
      @if( $orders->count() > 0 )
      <td colspan="2" class="center">{{ $report->totalpricestring }}</td>
      <td class="">รวม {{ $totalnumber }}</td>
      <td class="center">{{ number_format( $totalprice , 2 ) }}</td>
      @endif
  </tr>
</tfoot>
</table>

@endsection