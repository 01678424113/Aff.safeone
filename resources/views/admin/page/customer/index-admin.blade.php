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
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($data as $item)
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
                                            <td><input type="text" name="name" value="{{ $item->name }}"
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td><input type="text" name="email" value="{{ $item->email }}"
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td><input type="text" name="phone" value="{{ $item->phone }}"
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td>
                                            <textarea name="note" id="" cols="25" rows="3"
                                                      data-id=".customer-{{$item->id}}"
                                                      class="form-control">{{$item->note}}</textarea>
                                            </td>
                                            <td><input type="text" name="total" value="{{ $item->total }}"
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td><input type="text" name="percent" value="{{ $item->percent }}"
                                                       data-id=".customer-{{$item->id}}"
                                                       class="form-control"></td>
                                            <td>
                                                <select name="status" id="" class="form-control"
                                                        data-id=".customer-{{$item->id}}">
                                                    <option value="0" @if($item->status == 0) selected @endif>Đang xử
                                                        lý
                                                    </option>
                                                    <option value="1" @if($item->status == 1) selected @endif>Thành
                                                        công
                                                    </option>
                                                    <option value="-1" @if($item->status == -1) selected @endif>Thất
                                                        bại
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                @if($item->pay == 1)
                                                    <a class="btn-xs btn-success">
                                                        <small>Thanh toán</small>
                                                    </a>
                                                @else
                                                    <a class="btn-xs btn-danger">
                                                        <small>Chưa thanh toán</small>
                                                    </a>
                                                @endif
                                            </td>
                                        </form>
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
                }
            });
        });
    </script>
@endsection