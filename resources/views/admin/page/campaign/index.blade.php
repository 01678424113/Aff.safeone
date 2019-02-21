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
                        <form action="{{route('campaign.index')}}" method="get" id="search_category">
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-3 col-xs-12">
                                        Nhóm chiến dịch
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        {!! Form::select('category_id', [0 => 'Tất cả'] + $arrayCategories, $category_id, ['class' => 'form-control select2 select-category']) !!}
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a href="{{route('campaign.create')}}" class="btn sbold green"> Thêm chiến
                                                dịch
                                                <i class="fa fa-plus"></i>
                                            </a>
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
                                    <th>STT</th>
                                    <th>Tên chiến dịch</th>
                                    <th>Dịch vụ</th>
                                    <th>Thời gian tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Tham gia</th>
                                    @if(Auth::user()->getRoleNames()[0] == 'admin')
                                        <th>Khách hàng</th>
                                        <th>Hành động</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($data as $item)
                                    <tr class="odd gradeX">
                                        <td>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="checkboxes" value="1"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <button class="btn btn-xs @if($item->status == 1) btn-success @else btn-warning @endif">
                                                <small>@if($item->status == 1) Hoạt động @else Tạm ngưng @endif</small>
                                            </button>
                                        </td>
                                        <td>
                                            <form action="{{route('joinCampaign',['campaign_id'=>$item->id])}}"
                                                  method="post">
                                                @csrf
                                                @if(in_array($item->id,$campaign_join))
                                                    <button type="button" class="btn btn-xs btn-warning">
                                                        <small>Đã tham gia</small>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-xs btn-success">
                                                        <small>Tham gia</small>
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                        @if(Auth::user()->getRoleNames()[0] == 'admin')
                                            <td><a href="{{route('customer.indexAdmin',['campaign_id'=>$item->id])}}"
                                                   class="btn-xs btn-info">
                                                    <small>Xem khách</small>
                                                </a></td>
                                            <td>
                                                <a href="{{route('campaign.edit',['id'=>$item->id])}}"
                                                   class="btn btn-xs btn-info"><i
                                                            class="fa fa-pencil"></i></a>
                                                <button type="button" data-toggle="modal"
                                                        data-target="#myModal-{{$item->id}}"
                                                        class="btn btn-xs btn-danger"><i
                                                            class="fa fa-times"></i></button>
                                                <div id="myModal-{{$item->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <form action="{{route('campaign.destroy',['id'=>$item->id])}}"
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
                                                                    <p>Bạn muốn xóa chiến dịch này?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Hủy
                                                                    </button>
                                                                    <button type="submit" class="btn btn-danger">Tiếp
                                                                        tục
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
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
        $('.select-category').change(function () {
            $('#search_category').submit();
        })
    </script>
@endsection