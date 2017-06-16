@extends('layouts_pdf/main')

@section('content')

<h2>หมายเลขรายการขาย {{ $order->code }}</h2>
<hr>
<b>วันที่สั่งซื้อ</b> <br>
{{ $order->created_at->addYears(543)->format('d/m/Y') }} <br>
<b>ที่อยู่จัดส่ง</b> <br>
{{ $order->address }} <br>
<b>รหัสพัสดุ</b> <br>
{{ $order->emscode ? $order->emscode : '-' }} <br>
<b>สินค้าที่สั่งซื้อ</b> <br>
@if( $order->orderdetail )
<table class="one" cellspacing="0">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>ชื่อ</th>
        {{-- <th>รายละเอียด</th> --}}
        <th>ราคา (บาท)</th>
        <th class="right">จำนวน (ชิ้น)</th>
        <th class="right">รวม (บาท)</th>
    </tr>
</thead>
<tbody>
  @foreach( $order->orderdetail as $od )
  <tr>
    <td class="center">{{ $od->product->code }}</td>
    <td>{{ $od->product->name }}</td>
    {{-- <td>{{ $od->product->detail }}</td> --}}
    <td class="center">{{ number_format( $od->price, 2 ) }}</td>
    <td class="right">{{ $od->number }}</td>
    <td class="right">{{ number_format( $od->price * $od->number, 2 ) }}</td>
</tr>
@endforeach
</tbody>
<tfoot>
  <tr>
      <td colspan="3" class="right">รวม</td>
      <td class="right">{{ $order->sumnumber }}</td>
      <td class="right">{{ number_format( $order->totalprice , 2 ) }}</td>
  </tr>
  <tr>
      <td colspan="5" class="right"><br>{{ $order->totalpricestring }}
</tfoot>
</table>
@endif

@endsection