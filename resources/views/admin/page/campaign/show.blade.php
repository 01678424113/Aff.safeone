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
                <small>số điện thoại</small>
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
                                            <a href="{{route('campaign.create')}}" class="btn sbold green"> Thêm chiến dịch
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
                                    <th>Thông tin</th>
                                    <th>Sale</th>
                                    <th>Ngày</th>
                                    <th>Note</th>
                                    <th>Check</th>
                                    <th></th>
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
                                        <td>
                                            Tên: {{ $item->name }}<br>
                                            Email: {{ $item->email }}<br>
                                            SDT: {{ $item->phone }}<br>
                                            Nguồn: {{ $item->source }}<br>
                                            Trang thái: {{($item->status == \App\Models\Phone::$FAIL) ? 'Thất bại' : ''}}{{($item->status == \App\Models\Phone::$NOT_PROCESS) ? 'Chưa hỗ trợ' : ''}}{{($item->status == \App\Models\Phone::$PROCESS) ? 'Chờ phản hồi' : ''}}{{($item->status == \App\Models\Phone::$SUCCESS) ? 'Thành công' : ''}}
                                        </td>
                                        <td>{{ $item->sale }}</td>
                                        <td>{{ $item->time }}</td>
                                        <form action="{{route('phone.updateNote',['id'=>$item->id])}}"
                                              id="data-{{$item->id}}" method="post">
                                            @csrf
                                            <td>
                                            <textarea name="note" id="" cols="30" class="form-control" rows="10"
                                                      onblur="changeNote({{$item->id}})"
                                                      style="width: 100%">{{$item->note}}</textarea>
                                            </td>
                                            <td>
                                                <select name="status" class="form-control select-status" onchange="changeNote({{$item->id}})">
                                                    <option value="{{\App\Models\Phone::$FAIL}}" {{($item->status == \App\Models\Phone::$FAIL) ? 'selected' : ''}}>
                                                        Thất bại
                                                    </option>
                                                    <option value="{{\App\Models\Phone::$NOT_PROCESS}}" {{($item->status == \App\Models\Phone::$NOT_PROCESS) ? 'selected' : ''}}>
                                                        Chưa hỗ trợ
                                                    </option>
                                                    <option value="{{\App\Models\Phone::$PROCESS}}" {{($item->status == \App\Models\Phone::$PROCESS) ? 'selected' : ''}}>
                                                        Chờ phản hồi
                                                    </option>
                                                    <option value="{{\App\Models\Phone::$SUCCESS}}" {{($item->status == \App\Models\Phone::$SUCCESS) ? 'selected' : ''}}>
                                                        Thành công
                                                    </option>
                                                </select>
                                            </td>
                                        </form>
                                        <td class="text-center">
                                            <a href="{{route('phone.edit',['id'=>$item->id])}}"
                                               class="btn btn-xs btn-info"><i
                                                        class="fa fa-edit"></i></a>
                                            <a href="{{route('phone.destroy',['id'=>$item->id])}}"
                                               class="btn btn-xs btn-danger"><i
                                                        class="fa fa-times"></i></a>
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
        function changeNote(id) {
            var url = $("#data-" + id).attr('action');
            $.ajax({
                url: url,
                method: 'post',
                data: $("#data-" + id).serialize(),
                success: function (data) {
                    if (data['status']) {
                        console.log(data['message']);
                    } else {
                        console.log(data['message']);
                    }
                }
            })
        }
    </script>  <script>
        function changeNote(id) {
            var url = $("#data-" + id).attr('action');
            $.ajax({
                url: url,
                method: 'post',
                data: $("#data-" + id).serialize(),
                success: function (data) {
                    if (data['status']) {
                        console.log(data['message']);
                    } else {
                        console.log(data['message']);
                    }
                }
            })
        }
    </script>
@endsection