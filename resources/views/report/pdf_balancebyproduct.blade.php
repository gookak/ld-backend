@extends('layouts_pdf/main')

@section('content')


<table boder="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="center"><b>{{ $report->name }}</b></td>
        </tr>
        <tr><td class="center">ประจำวันที่ {{ $report->create_date }} </td>
        </tr>
    </tbody>
</table>

<table class="one" cellspacing="0">
    <thead>
      <tr>
        {{-- <th>ประเภทสินค้า</th> --}}
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>ราคาต่อหน่วย (บาท)</th>
        <th>คงเหลือ (ชิ้น)</th>
    </tr>
</thead>
<tbody>
    @if( $products )
    @php 
    $totalnumber = 0; 
    @endphp

    @foreach( $products as $product )
    <tr>
        {{-- <td>{{ $product->category->name }}</td> --}}
        <td>{{ $product->code }}</td>
        <td>{{ $product->name }}</td>
        <td class="center">{{ number_format( $product->price, 2 ) }}</td>
        <td class="center">{{ $product->balance }}</td>
    </tr>
    @php 
    $totalnumber += $product->balance;
    @endphp
    @endforeach
    @endif
</tbody>
<tfoot>
  <tr>
      <td colspan="3" class="right">รวม</td>
      <td class="center">{{ $totalnumber }}</td>
  </tr>
</tfoot>
</table>

@endsection