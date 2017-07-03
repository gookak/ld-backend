@extends('layouts/main')

@section('content')

<div class="page-header">
    <h1>{{ $header_text }}</h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <div class="clearfix">
            <div id="msgErrorArea"></div>
        </div>

        <div id="productreceive-detail">
            <div id="accordion" class="accordion-style1 panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;ข้อมูลสินค้า
                            </a>
                        </h4>
                    </div>

                    <div class="panel-collapse collapse in" id="collapseOne">
                        <div class="panel-body">
                            <div class="profile-user-info">

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> ประเภทสินค้า </div>
                                    <div class="profile-info-value">
                                        <span>{{ $product->category->name }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> ชื่อ </div>
                                    <div class="profile-info-value">
                                        <span>{{ $product->name }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> ราคาขาย/บาท </div>
                                    <div class="profile-info-value">
                                        <span>{{ $product->price }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> จำนวนคงเหลือ </div>
                                    <div class="profile-info-value">
                                        <span>{{ $product->balance }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> จำนวนคงเหลือ (แจ้งเตือน) </div>
                                    <div class="profile-info-value">
                                        <span>{{ $product->balance_check }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> คำอธิบาย </div>
                                    <div class="profile-info-value">
                                        <span>{{ $product->detail }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> รูปภาพ </div>
                                    <div class="profile-info-value">
                                        @if ( $product->productImage )
                                        <ul id="ul-image" class="ace-thumbnails clearfix">
                                            @foreach($product->productImage as $productImage)
                                            <li data-fileid="{{ $productImage->fileupload->id }}">
                                                <img width="150" height="150" alt="150x150" src="{{ asset(env('FILE_URL').$productImage->fileupload->filename )}}">
                                            {{-- <div class="tools tools-bottom">
                                                <a class="a-del"><i class="ace-icon fa fa-times red"></i></a>
                                            </div> --}}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;ประวัติการรับสินค้า
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseThree">
                    <div class="panel-body">
                        <table id="tb-productreceive" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>วันที่รับของ</th>
                                    <th>ผู้รับ</th>
                                    <th>จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $product->productreceive as $productreceive)
                                <tr>
                                    <td>{{ $productreceive->created_at ? $productreceive->created_at->addYears(543)->format('d/m/Y') : null }}</td>
                                    <td>{{ $productreceive->admins->firstname }} {{ $productreceive->admins->lastname }}</td>
                                    <td>{{ $productreceive->number }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <a class="btn btn-sm btn-default" href="/product">
        <i class="ace-icon fa fa-reply bigger-110"></i>
        ยกเลิก
    </a>
    <!-- PAGE CONTENT ENDS -->
</div>
</div>


@section('tag-footer')

<script type="text/javascript">
    $(function () {


    });
</script>

@stop

@stop