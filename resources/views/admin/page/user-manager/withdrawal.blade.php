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
                <small>tài khoản</small>
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
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{$title}} </span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                                        <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                    <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                                        <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="{{ route('user-admin.doWithdrawal') }}" method="post"
                                  class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Số tiền
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="number" name="amount" data-required="1" class="form-control" placeholder="Tối đa {{number_format($user->amount)}} VND"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">Tạo yêu cầu</button>
                                            <a href="{{ route('user-admin.index') }}"
                                               class="btn grey-salsa btn-outline">Quay lại</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="sample_1">
                                <thead>
                                <tr>
                                    <th> #</th>
                                    <th>Mã giao dịch</th>
                                    <th>Người nhận</th>
                                    <th>Khách hàng</th>
                                    <th>Loại giao dịch</th>
                                    <th>Số tiền</th>
                                    <th>Thời gian giao dịch</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($data as $item)
                                    <tr class="odd gradeX">
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->transaction_id }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>
                                            @if($item->type == \App\Models\Transaction::$TYPE_PLUS)
                                                <label class="label label-success">Cộng tiền</label>
                                            @elseif($item->type == \App\Models\Transaction::$TYPE_MINUS)
                                                <label class="label label-danger">Trừ tiền</label>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->amount) }}</td>
                                        <td>{{ date('H:i:s d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @if($item->status == \App\Models\Transaction::$STATUS_SUCCESS)
                                                <label class="label label-success">Thành công</label>
                                            @elseif($item->status == \App\Models\Transaction::$STATUS_PENDING)
                                                <label class="label label-warning">Đang xử lý</label>
                                            @elseif($item->status == \App\Models\Transaction::$STATUS_FAILURE)
                                                <label class="label label-danger">Thất bại</label>
                                            @elseif($item->status == \App\Models\Transaction::$STATUS_CANCEL)
                                                <label class="label label-default">Hủy bỏ</label>
                                            @elseif($item->status == \App\Models\Transaction::$STATUS_INIT)
                                                <label class="label label-default">Mới tạo</label>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                                </tbody>
                            </table>
                            {{$data->links()}}
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection