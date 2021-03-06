@extends('admin.layout')
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->
        @include('admin.layouts.theme-panel')
        <!-- END THEME PANEL -->
            <h1 class="page-title"> {{$title}}
                <small>khách hàng</small>
            </h1>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="{{route('home')}}">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">{{$title}}</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle"
                                data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                            Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        {{--       <ul class="dropdown-menu pull-right" role="menu">
                                   <li>
                                       <a href="#">
                                           <i class="icon-bell"></i> Action</a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="icon-shield"></i> Another action</a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="icon-user"></i> Something else here</a>
                                   </li>
                                   <li class="divider"></li>
                                   <li>
                                       <a href="#">
                                           <i class="icon-bag"></i> Separated link</a>
                                   </li>
                               </ul>--}}
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <div class="m-heading-1 border-green m-bordered">
                <h3>Chú ý: </h3>
                <p></p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">{{$title}}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                        <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                    <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn green  btn-outline dropdown-toggle"
                                                    data-toggle="dropdown">Công cụ
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-print"></i> Print </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="sample_1">
                                <thead>
                                <tr>
                                    <th class="table-checkbox">
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable"
                                                   data-set="#sample_3 .checkboxes"/>
                                            <span></span>
                                        </label>
                                    </th>
                                    <th> #</th>
                                    <th> Tên</th>
                                    <th> Email</th>
                                    <th> Số điện thoại</th>
                                    <th> Note</th>
                                    <th> Tổng tiền</th>
                                    <th> Hoa hồng(%)</th>
                                    <th> Trạng thái</th>
                                    <th> Thanh toán</th>
                                    <th> Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($data as $item)
                                    <?php
                                    $disable = '';
                                    if ($item->pay == \App\Models\Customer::$PAID) {
                                        $disable = 'disabled';
                                    }
                                    ?>
                                    <tr class="odd gradeX">
                                        <form action="{{route('customer.update',['id'=>$item->id])}}" method="post"
                                              class="customer-{{$item->id}}">
                                            @csrf
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="checkboxes" value="1"/>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>{{ $i }}</td>
                                            <td><input type="text" name="name" value="{{ $item->name }}" {{$disable}}
                                                data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td><input type="email" name="email" value="{{ $item->email }}" {{$disable}}
                                                data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td><input type="text" name="phone" value="{{ $item->phone }}" {{$disable}}
                                                data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td>
                                            <textarea name="note" id="" cols="25" rows="3"
                                                      data-id=".customer-{{$item->id}}"
                                                      class="form-control">{{$item->note}}</textarea>
                                            </td>
                                            <td><input type="text" name="total" {{$disable}}
                                                value="@if( $item->total != 0) {{number_format($item->total)}} @endif"
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td><input type="number" name="percent" value="{{ $item->percent }}"
                                                       {{$disable}}
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td>
                                                <select name="status" id="" class="form-control" {{$disable}}
                                                data-id=".customer-{{$item->id}}">
                                                    <option value="0"
                                                            @if($item->status == \App\Models\Customer::$WAIT) selected @endif>
                                                        Đang xử
                                                        lý
                                                    </option>
                                                    <option value="1"
                                                            @if($item->status == \App\Models\Customer::$SUCCESS) selected @endif>
                                                        Thành
                                                        công
                                                    </option>
                                                    <option value="-1"
                                                            @if($item->status == \App\Models\Customer::$FAIL) selected @endif>
                                                        Thất
                                                        bại
                                                    </option>
                                                </select>
                                            </td>
                                        </form>
                                        <td>
                                            @if($item->pay == \App\Models\Customer::$PAID)
                                                <button type="button" class="btn-xs btn-success">
                                                    <small>Đã thanh toán</small>
                                                </button>
                                            @elseif($item->pay == \App\Models\Customer::$NOPAID || $item->pay == \App\Models\Customer::$REQUESTPAID)
                                                <form action="{{route('customer.pay',['id'=>$item->id])}}"
                                                      method="post">
                                                    @csrf
                                                    <input type="hidden" name="amount"
                                                           value="@if( $item->total != 0) {{$item->total*$item->percent/100}} @endif">
                                                    <input type="hidden" name="customer_id" value="{{$item->id}}">
                                                    <input type="hidden" name="aff_id" value="{{$item->aff_id}}">
                                                    <input type="hidden" name="note"
                                                           value="Thanh toán khách hàng id {{$item->id}}">
                                                    <input type="hidden" name="type"
                                                           value="{{\App\Models\Transaction::$TYPE_PLUS}}">
                                                    <button type="submit" class="btn-xs btn-danger">
                                                        <small>Thanh toán ngay</small>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                    data-target="#myModal-{{$item->id}}"
                                                    class="btn btn-xs btn-danger"><i
                                                        class="fa fa-times"></i></button>
                                            <div id="myModal-{{$item->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <form action="{{route('customer.destroy',['id'=>$item->id])}}"
                                                          method="get">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                                <h4 class="modal-title">Xóa</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Bạn muốn xóa khách hàng này?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Hủy
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">Tiếp tục
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
@section('script')
    <script>
        $('input').change(function () {
            var id = $(this).attr('data-id');
            var url = $(id).attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: $(id).serialize(),
                success: function (res) {
                    alert(res);
                    console.log(res);
                    location.reload();
                }
            });
        });
        $('textarea').change(function () {
            var id = $(this).attr('data-id');
            var url = $(id).attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: $(id).serialize(),
                success: function (res) {
                    alert(res);
                    console.log(res);
                    location.reload();
                }
            });
        });
        $('select').change(function () {
            var id = $(this).attr('data-id');
            var url = $(id).attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: $(id).serialize(),
                success: function (res) {
                    alert(res);
                    console.log(res);
                    location.reload();
                }
            });
        });
    </script>
@endsection