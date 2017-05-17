@extends('layouts/main')

@section('content')

{{-- <div class="page-header">
    <h1>
        {{ $header_text }}
    </h1>
</div> --}}

<div class="row">
    <div class="clearfix">
        <div id="msgErrorArea"></div>
    </div> 
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="widget-title smaller">
                    {{-- <i class="ace-icon fa fa-check-square-o bigger-110"></i> --}}
                    ข้อมูลส่วนบุคคล
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <ul class="list-unstyled">
                        <li>{{ $user->firstname }} {{ $user->lastname }}</li>
                        <li>{{ $user->email }}</li>
                        <li><a href="#" class="pink">แก้ไข</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="widget-title smaller">
                    {{-- <i class="ace-icon fa fa-check-square-o bigger-110"></i> --}}
                    ข้อมูลที่อยู่
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        @for ($i = 0; $i <= 6; $i++)
                        <div class="col-xs-4">
                            <div class="widget-box">
                            {{-- <div class="widget-header widget-header-flat">
                                <h4 class="widget-title">Lists</h4>
                            </div> --}}

                            <div class="widget-body">
                                <div class="widget-main">
                                    <ul class="list-unstyled">
                                        <li>Unordered List Item</li>
                                        <li>Unordered List Item</li>
                                        <li>Unordered List Item</li>
                                        <li><a href="#" class="pink">แก้ไข</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                    
                </div>
            </div>
        </div>

    </div>

    <div class="widget-box transparent">
        <div class="widget-header widget-header-small">
            <h4 class="widget-title smaller">
                {{-- <i class="ace-icon fa fa-check-square-o bigger-110"></i> --}}
                Orders
            </h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
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