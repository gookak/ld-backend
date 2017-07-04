@extends('layouts_pdf/main')

@section('content')

<table boder="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="center"><b>{{ $reportname }}</b></td>
        </tr>
    </tbody>
</table>


<table class="one" cellspacing="0">
    <thead>
      <tr>
          <tr>
            <th>ประเภทสินค้า/รหัสสินค้า</th>
            <th>ชื่อ</th>
            <th>จำนวนคงเหลือ (แจ้งเตือน)</th>
            <th>จำนวนคงเหลือ</th>
        </tr>
    </tr>
</thead>
<tbody>


    @if( $products->count() > 0 )
    @foreach( $categorys as $category )
    <tr>
        <td colspan="4" class="color-bg-01"><b>{{ $category->name}}</b></td>
    </tr>



    @foreach($products as $product)
    @if($category->id == $product->category_id)
    <tr>             
        <td>&nbsp;&nbsp; {{ $product->code }}</td>
        <td>{{ $product->name }}</td>
        <td class="center">{{ $product->balance_check }}</td>
        <td class="center">{{ $product->balance }}</td>
    </tr>
    @endif
    @endforeach


    @endforeach
    @endif


</tbody>
{{-- <tfoot>
  <tr>
      <td colspan="4" class="right">รวม</td>
  </tr>
</tfoot> --}}
</table>

@endsection