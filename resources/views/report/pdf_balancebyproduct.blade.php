@extends('layouts_pdf/main')

@section('content')
{{-- {{ $categorys }} --}}

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
        <th>ประเภทสินค้า/รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        {{-- <th>ราคาต่อหน่วย (บาท)</th> --}}
        <th>คงเหลือ (ชิ้น)</th>
    </tr>
</thead>
<tbody>
    @php 
    $totalnumber = 0; 
    @endphp
    @if( $products->count() > 0 )
    @foreach( $categorys as $category )
    <tr>
        <td colspan="2" class="color-bg-01"><b>{{ $category->name}}</b></td>
        <td class="color-bg-01 center"><b>{{ $category->sumbalance}}</b></td>
    </tr>
    @foreach( $products as $product )
    @if($category->id == $product->category_id)
    <tr>
        <td>&nbsp;&nbsp; {{ $product->code }}</td>
        <td>{{ $product->name }}</td>
        {{-- <td class="center">{{ number_format( $product->price, 2 ) }}</td> --}}
        <td class="center">{{ $product->balance }}</td>
    </tr>
    @php 
    $totalnumber += $product->balance;
    @endphp
    @endif
    @endforeach
    @endforeach
    @else
    <tr>
        <td colspan="3" class="center"><b>ไม่พบข้อมูล</b></td>
    </tr>
    @endif
</tbody>
<tfoot>
  <tr>
      <td colspan="2" class="right">รวม</td>
      <td class="center">{{ number_format( $totalnumber ) }}</td>
  </tr>
</tfoot>
</table>

@endsection