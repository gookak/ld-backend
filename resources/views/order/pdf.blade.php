<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>

    {{-- <link href="https://fonts.googleapis.com/css?family=Trirong" rel="stylesheet"> --}}
    
    <style type="text/css">
        

        body {
            /*font-family: "THSarabunNew";*/
            font-family: 'Trirong', serif;
        }

        .center{
            text-align: center;
        }
        .right{
            text-align: right;
        }
        .left: {
            text-align: left;
        }


        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        table.three{
            /*width:60%;*/
            border:0; 
        } 
        table.three th { 
            font-weight:bold; 
            border-bottom:1px solid #CCC; 
            border-top:1px solid #CCC; 
            background-color:#dddddd ;
            /*color:#0000CC;*/
        }
        table.three td { 
            padding:5px; 
            border-bottom:1px dotted #CCC; 
        }
        table.three tfoot td{ 
            border-bottom:0px dotted #CCC; 
        }




    </style>
</head>
<body>
    <h2>Order # {{ $order->code }}</h2>
    <hr>
    <b>วันที่สั่งซื้อ</b> <br>
    {{ $order->created_at->addYears(543)->format('d/m/Y') }} <br>
    <b>ที่อยู่จัดส่ง</b> <br>
    {{ $order->address }} <br>
    <b>รหัสพัสดุ</b> <br>
    {{ $order->emscode ? $order->emscode : '-' }} <br>
    <b>สินค้าที่สั่งซื้อ</b> <br><br>
    @if( $order->orderdetail )
    <table class="three" cellspacing="0">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>รายละเอียด</th>
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
                <td>{{ $od->product->detail }}</td>
                <td class="center">{{ number_format( $od->price, 2 ) }}</td>
                <td class="right">{{ $od->number }}</td>
                <td class="right">{{ number_format( $od->price * $od->number, 2 ) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="right">รวม</td>
                <td class="right">{{ $order->sumnumber }}</td>
                <td class="right">{{ number_format( $order->totalprice , 2 ) }}</td>
            </tr>
            {{-- <tr>
                <td colspan="5" class="right">ยอดสุทธิ</td>
                <td class="right">{{ number_format( $order->totalprice , 2 ) }}</td>
            </tr> --}}
        </tfoot>
    </table>
    @endif






</body>
</html>