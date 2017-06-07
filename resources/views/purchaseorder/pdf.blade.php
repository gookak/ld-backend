@extends('layouts_pdf/main')

@section('content')

{{-- <link rel="stylesheet" href="http://localhost:8000/css/pdf.css" /> --}}


<table boder="0" cellspacing="0">
    <tbody>
        <tr>
            <td class="center">
                <h3>ใบสั่งของ</h3><br><br>
            </td>
        </tr>
        <tr>
            <td>
                <b>เลขที่ {{ $purchaseorder->code }}</b><br>
                วันที่สั่ง {{ $purchaseorder->order_at ? $purchaseorder->order_at->addYears(543)->format('d/m/Y') : null }}
            </td>
        </tr>
    </tbody>
</table>

<table boder="0" cellspacing="0">
    <tbody>
        <tr>
            <td>
                <b>ข้อมูลร้านค้า (ผู้ขาย)</b><br>
                {{ $purchaseorder->vendor->name }}<br>
                {{ $purchaseorder->vendor->address }}<br>
                เบอร์โทร {{ $purchaseorder->vendor->tel ? $purchaseorder->vendor->tel : '-' }}<br>
                FAX. {{ $purchaseorder->vendor->fax ? $purchaseorder->vendor->fax : '-' }}<br>
            </td>
            {{-- <td>
                <b>ข้อมูลผู้ติดต่อ</b><br>
                ร้าน L&D.COM<br>
                บิ๊กซีบางพลี ชั้น 2 เลขที่ 89 หมู่ 9 ถนนเทพารักษ์ กม.13 ถนนเทพารักษ์ ต.บางพลีใหญ่ อ.บางพลี จ.สมุทรปราการ 10540<br>
                ผู้ติดต่อ {{ $purchaseorder->admin->name }}<br>
                เบอร์โทร {{ $purchaseorder->admin->tel ? $purchaseorder->admin->tel : '-' }}
            </td> --}}
        </tr>
    </tbody>
</table>

<table class="one" cellspacing="0">
    <thead>
        <tr>
            <th class="center width-10">ลำดับ</th>
            <th class="center">ชื่อ</th>
            <th class="center width-15">จำนวน (ชิ้น)</th>
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
            <td colspan="2" class="right"><b>รวม</b></td>
            <td class="center"><b>{{ $totalnumber }}</b></td>
        </tr>
    </tfoot>
</table>

@endsection