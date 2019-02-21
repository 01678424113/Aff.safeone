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
                                    <th>Khách hàng</th>
                                    <th>Thời gian tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                ?>
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
                                        <td><a target="_blank" class="btn-xs     btn-info" href="{{route('customer.index',['campaign_id'=>$item->id])}}"><small>Xem khách</small></a></td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <button class="btn btn-xs @if($item->status == 1) btn-success @else btn-warning @endif">
                                                <small>@if($item->status == 1) Hoạt động @else Tạm ngưng @endif</small>
                                            </button>
                                        </td>
                                        <td>
                                        @if(!isset($item->affiliate[0]))
                                                <button type="button" class="btn btn-xs btn-info btn-create-aff"
                                                        data-campaign-id="{{$item->id}}">
                                                    <small>Tạo link affiliate</small>
                                                </button>
                                                <div id="myModal-{{$item->id}}" class="modal fade"
                                                     role="dialog">
                                                    <div class="modal-dialog">
                                                        <input type="hidden" name="campaign_id"
                                                               value="{{$item->id}}">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                                <h4 class="modal-title">{{'AFF '.$item->name }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="root_url"></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Đóng
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-xs btn-info btn-create-aff"
                                                        data-campaign-id="{{$item->id}}">
                                                    <small>Xem link affiliate</small>
                                                </button>
                                                <div id="myModal-{{$item->id}}" class="modal fade"
                                                     role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                                <h4 class="modal-title">{{'AFF '.$item->name }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class=""><a target="_blank" href="{{route('affRedirectStep1',['aff_id'=>$item->aff_id])}}">{{route('affRedirectStep1',['aff_id'=>$item->aff_id])}}</a></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Đóng
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                                <form action="{{route('createLinkAFF')}}" id="form-create-aff"
                                      method="post">
                                    @csrf
                                    <input type="hidden" name="campaign_id" value="">

                                </form>
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
        $('.btn-create-aff').click(function () {
            var campaign_id = $(this).attr('data-campaign-id');
            $('input[name=campaign_id]').val(campaign_id);
            $.ajax({
                url: "{{route('createLinkAFF')}}",
                type: 'post',
                data: $('#form-create-aff').serialize()
            }).done(function (res) {
                if (res.status === 1) {
                    var link = "{{route('affRedirectStep1',['aff_id'=>'aff_id'])}}";
                    link = link.replace('aff_id', res.aff_id);
                    $('.root_url').html('<a href="' + link + '">' + link + '</a>');
                    $("#myModal-" + res.campaign_id).modal()
                } else {
                    console.log(res);
                    alert('Link không hợp lệ');
                }
            });
        });
    </script>
@endsection