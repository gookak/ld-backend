@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Static &amp; Dynamic Tables
        </small>
    </h1>
</div><!-- /.page-header -->


<div class="row center">
    <div class="col-sm-3">
        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-twitter"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">11,000 บาท</span>
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
                <i class="ace-icon fa fa-flask"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">7</span>
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
                <span class="infobox-data-number">{{ $countOrder }} รายการ</span>
                <div class="infobox-content">รายการสั่งซื้อวันนี้</div>
            </div>
            {{-- <div class="stat stat-important">4%</div> --}}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-comments"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">32 คน</span>
                <div class="infobox-content">สมาชิกใหม่วันนี้</div>
            </div>

            {{-- <div class="stat stat-success">8%</div> --}}
        </div>
    </div>
</div>

<div class="hr hr32 hr-dotted"></div>

<div class="row">
    <div class="col-sm-6">
        <h3 class="header smaller lighter blue">สินค้าขายดีวันนี้</h3>
        <table class="table table-bordered table-striped">
            <thead class="thin-border-bottom">
                <tr>
                    <th>
                        <i class="ace-icon fa fa-caret-right blue"></i>name
                    </th>

                    <th>
                        <i class="ace-icon fa fa-caret-right blue"></i>price
                    </th>

                    <th class="hidden-480">
                        <i class="ace-icon fa fa-caret-right blue"></i>status
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>internet.com</td>

                    <td>
                        <small>
                            <s class="red">$29.99</s>
                        </small>
                        <b class="green">$19.99</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-info arrowed-right arrowed-in">on sale</span>
                    </td>
                </tr>

                <tr>
                    <td>online.com</td>

                    <td>
                        <b class="blue">$16.45</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-success arrowed-in arrowed-in-right">approved</span>
                    </td>
                </tr>

                <tr>
                    <td>newnet.com</td>

                    <td>
                        <b class="blue">$15.00</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-danger arrowed">pending</span>
                    </td>
                </tr>

                <tr>
                    <td>web.com</td>

                    <td>
                        <small>
                            <s class="red">$24.99</s>
                        </small>
                        <b class="green">$19.95</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label arrowed">
                            <s>out of stock</s>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>domain.com</td>

                    <td>
                        <b class="blue">$12.00</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-warning arrowed arrowed-right">SOLD</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <h3 class="header smaller lighter blue">รายการสั่งซื้อล่าสุด</h3>
        <table class="table table-bordered table-striped">
            <thead class="thin-border-bottom">
                <tr>
                    <th>
                        <i class="ace-icon fa fa-caret-right blue"></i>name
                    </th>

                    <th>
                        <i class="ace-icon fa fa-caret-right blue"></i>price
                    </th>

                    <th class="hidden-480">
                        <i class="ace-icon fa fa-caret-right blue"></i>status
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>internet.com</td>

                    <td>
                        <small>
                            <s class="red">$29.99</s>
                        </small>
                        <b class="green">$19.99</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-info arrowed-right arrowed-in">on sale</span>
                    </td>
                </tr>

                <tr>
                    <td>online.com</td>

                    <td>
                        <b class="blue">$16.45</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-success arrowed-in arrowed-in-right">approved</span>
                    </td>
                </tr>

                <tr>
                    <td>newnet.com</td>

                    <td>
                        <b class="blue">$15.00</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-danger arrowed">pending</span>
                    </td>
                </tr>

                <tr>
                    <td>web.com</td>

                    <td>
                        <small>
                            <s class="red">$24.99</s>
                        </small>
                        <b class="green">$19.95</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label arrowed">
                            <s>out of stock</s>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>domain.com</td>

                    <td>
                        <b class="blue">$12.00</b>
                    </td>

                    <td class="hidden-480">
                        <span class="label label-warning arrowed arrowed-right">SOLD</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="hr hr32 hr-dotted"></div>

<div class="row">
    <div class="col-sm-6">
        <div id="product-balance"></div>
    </div>
</div>

<div class="hr hr32 hr-dotted"></div>




@section('tag-footer')

<script type="text/javascript">
    $(function () {

        Highcharts.chart('product-balance', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: 'ยอดขายประจำวันแบ่งตามประเภทสินค้า'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: false,
                        format: '{point.name}'
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                ['Firefox', 45.0],
                ['IE', 26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari', 8.5],
                ['Opera', 6.2],
                ['Others', 0.7]
                ]
            }]
        });

    });
</script>

@stop

@stop