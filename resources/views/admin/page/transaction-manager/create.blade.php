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
                <small>giao dịch</small>
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
                                <span class="caption-subject font-red sbold uppercase">{{$title}}</span>
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
                            <form action="{{ route('transaction-manager.store') }}" method="post"
                                  class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Chọn user<span
                                                    class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            {!! Form::select('user_id', $listUser, old('user_id'), ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Loại
                                            giao dịch</label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <select name="type" id="" class="form-control select2">
                                                <option value="{{\App\Models\Transaction::$TYPE_PLUS}}">Cộng
                                                    tiền
                                                </option>
                                                <option value="{{\App\Models\Transaction::$TYPE_MINUS}}">Trừ
                                                    tiền
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Trang
                                            thái</label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <select name="status" id="" class="form-control">
                                                <option value="{{\App\Models\Transaction::$STATUS_SUCCESS}}">
                                                    Thành công
                                                </option>
                                                <option value="{{\App\Models\Transaction::$STATUS_PENDING}}">
                                                    Đang xử lý
                                                </option>
                                                <option value="{{\App\Models\Transaction::$STATUS_FAILURE}}">
                                                    Thất bại
                                                </option>
                                                <option value="{{\App\Models\Transaction::$STATUS_CANCEL}}">
                                                    Hủy bỏ
                                                </option>
                                                <option value="{{\App\Models\Transaction::$STATUS_INIT}}">
                                                    Mới tạo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Số
                                            tiền<span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="number" name="amount" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Lý
                                            do<span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <textarea class="resizable_textarea form-control" rows="5"
                                                                  required id="" name="note" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">Tạo mới</button>
                                            <a href="{{ route('transaction-manager.individual') }}"
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
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection