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
                <small>chiến dịch</small>
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
                            <form action="{{ route('campaign.store') }}" method="post"
                                  class="form-horizontal form-label-left" id="form-update-campaign">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tên
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" name="name" data-required="1" value=""
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Sắp xếp
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <input name="sort_by" type="text" class="form-control"
                                                   value=""/></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Dịch vụ
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            {!! Form::select('category_id', $arrayCategories, '', ['class' => 'form-control select2 select-category']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Trạng thái
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <div class="mt-checkbox-list">
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" name="status"/>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn green"
                                            onclick="document.getElementById('form-update-campaign').submit();">
                                        Lưu
                                    </button>
                                    <a href="{{ route('campaign.index') }}"
                                       class="btn grey-salsa btn-outline">Quay lại</a>
                                </div>
                            </div>
                        </div>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
@section('script')

@endsection