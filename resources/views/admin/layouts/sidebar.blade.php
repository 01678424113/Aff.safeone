<?php
if (Auth::user()->getRoleNames()[0] == 'admin') {
    $routes = [
        'home',
        'user-admin.index',
        'user-admin.create',
        'role.index',
        'permission.index',
        'category.index',
        'campaign.index',
        'campaign.myCampaign',
        'transaction-manager.index',
        'transaction-manager.individual',
        'transaction-manager.listRequestPaid'
    ];
} elseif (Auth::user()->getRoleNames()[0] == 'user') {
    $routes = [
        'home',
        'category.index',
        'campaign.index',
        'campaign.myCampaign',
        'transaction-manager.individual',
    ];
}

?>
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false"
            data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start active open">
                <a href="{{ route('home') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Trang chủ</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Quản lý tài khoản</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @if(in_array('user-admin.index',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('user-admin.index') }}" class="nav-link ">
                                <span class="title">Danh sách tài khoản</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('user-admin.create',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('user-admin.create') }}" class="nav-link ">
                                <span class="title">Tạo mới tài khoản</span>
                            </a>
                        </li>
                    @endif
                        <li class="nav-item  ">
                            <a href="{{ route('user-admin.withdrawal') }}" class="nav-link ">
                                <span class="title">Rút tiền</span>
                            </a>
                        </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-action-redo"></i>
                    <span class="title">Phân quyền</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @if(in_array('role.index',$routes))
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link ">
                                <span class="title">Vai trò</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('permission.index',$routes))
                        <li class="nav-item ">
                            <a href="{{ route('permission.index') }}" class="nav-link ">
                                <span class="title">Quyền</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-puzzle"></i>
                    <span class="title">Dịch vụ</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @if(in_array('category.index',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('category.index') }}" class="nav-link ">
                                <span class="title">Dịch vụ</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-anchor"></i>
                    <span class="title">Chiến dịch</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @if(in_array('campaign.index',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('campaign.index') }}" class="nav-link ">
                                <span class="title">Dach sách chiến dịch</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('campaign.myCampaign',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('campaign.myCampaign') }}" class="nav-link ">
                                <span class="title">Chiến dịch của bạn</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Giao dịch</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @if(in_array('transaction-manager.index',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('transaction-manager.index') }}" class="nav-link ">
                                <span class="title">Dách sách giao dịch</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('transaction-manager.individual',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('transaction-manager.individual') }}" class="nav-link ">
                                <span class="title">Giao dịch của tôi</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('transaction-manager.listRequestPaid',$routes))
                        <li class="nav-item  ">
                            <a href="{{ route('transaction-manager.listRequestPaid') }}" class="nav-link ">
                                <span class="title">Yêu cầu thanh toán</span>
                            </a>
                        </li>
                    @endif
                        <li class="nav-item  ">
                            <a href="{{ route('transaction-manager.listWidrawal') }}" class="nav-link ">
                                <span class="title">Yêu cầu rút tiền</span>
                            </a>
                        </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>