<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
        <meta name="author" content="ParkerThemes">
        <link rel="shortcut icon" href="{{asset('custom/img/fav.png')}}">

        <!-- Title -->
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- *************
            ************ Common Css Files *************
        ************ -->
        <!-- Bootstrap css -->
        {!!Html::style('custom/css/bootstrap.min.css')!!}
        
        <!-- Icomoon Font Icons css -->
        {!!Html::style('custom/fonts/style.css')!!}

        <?php 
        $checkThemeforUser=DB::table('theme_setting')->where('user_id', Auth::id())->first();
        ?>
        @if($checkThemeforUser->theme_id == 1)
        <!-- Main css for blue -->
        {!!Html::style('custom/css/main.css')!!}
        @elseif($checkThemeforUser->theme_id == 2)
        <!-- Main css for dark -->
        {!!Html::style('custom/css/dark-main.css')!!}
        @elseif($checkThemeforUser->theme_id == 3)
        <!-- Main css for green -->
        {!!Html::style('custom/css/green-main.css')!!}
        @elseif($checkThemeforUser->theme_id == 4)
        <!-- Main css for red -->
        {!!Html::style('custom/css/red-main.css')!!}
        @elseif($checkThemeforUser->theme_id == 5)
        <!-- Main css for violet -->
        {!!Html::style('custom/css/violet-main.css')!!}
        @else
        {!!Html::style('custom/css/red-main.css')!!}
        @endif


        <!-- *************
            ************ Vendor Css Files *************
        ************ -->

        <!-- Mega Menu -->
        {!!Html::style('custom/vendor/megamenu/css/megamenu.css')!!}

        <!-- Search Filter JS -->
        {!!Html::style('custom/vendor/search-filter/search-filter.css')!!}
        {!!Html::style('custom/vendor/search-filter/custom-search-filter.css')!!}

        <!-- Data Tables -->
        {!!Html::style('custom/vendor/datatables/dataTables.bs4.css')!!}
        {!!Html::style('custom/vendor/datatables/dataTables.bs4-custom.css')!!}
        {!!Html::style('custom/vendor/datatables/buttons.bs.css')!!}
        <!-- Date Range CSS -->
        {!!Html::style('custom/vendor/daterange/daterange.css')!!}
        <style type="text/css">
            @keyframes zoominoutsinglefeatured {
                0% {
                    transform: scale(1,1);
                }
                50% {
                    transform: scale(1.2,1.2);
                }
                100% {
                    transform: scale(1,1);
                }
            }
            .logo img {
                animation: zoominoutsinglefeatured 1s infinite ;
            }

            /*.sidebar-wrapper .sidebar-tabs .nav{
                width: 100% !important;
            }*/
        </style>
    </head>
    <body>

        <!-- Loading wrapper start -->
        <div id="loading-wrapper">
            <div class="spinner-border"></div>
            Loading...
        </div>
        <!-- Loading wrapper end -->

        <?php
            $baseUrl = URL::to('/');
            $url = Request::path();
            $currencyInfo = DB::table('currency')->where('id', 1)->first();
            if (!Session::has('currency')) {
                Session::put('currency', $currencyInfo->symbol);
            }
        ?>
        <!-- Page wrapper start -->
        <div class="page-wrapper">
            
            <!-- Sidebar wrapper start -->
            <nav class="sidebar-wrapper">

                <!-- Sidebar content start -->
                <div class="sidebar-tabs">
                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2 || Auth::user()->user_type == 3)
                    <!-- Tabs nav start -->
                    <div class="nav" role="tablist" aria-orientation="vertical">
                        <!-- <a href="{{URL::To('home')}}" class="logo">
                            <img src="{{asset('custom/img/logo.svg')}}" alt="Uni Pro Admin">
                        </a> -->
                        <a class="nav-link {{($url=='home' || $url==config('app.account').'/daily-transaction' || $url==config('app.account').'/final-report' || $url==config('app.or').'/receive-voucher-report' || $url==config('app.op').'/payment-voucher-report' || $url==config('app.hc').'/room-list-report' || $url==config('app.account').'/overall-income-report' || $url==config('app.account').'/overall-expense-report') ? 'active':''}}" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab" aria-controls="tab-home" aria-selected="true">
                            <i class="icon-home2"></i>
                            <span class="nav-link-text">Dashboard </span>
                        </a>
                        <a class="nav-link {{($url==config('app.account').'/account-type' || $url==(request()->is(config('app.account').'/account-type/*/edit')) || $url==config('app.account').'/bank-account' || $url==config('app.account').'/cheque-book' || $url==config('app.account').'/cheque-no' || $url==(request()->is(config('app.account').'/bank-deposit/*')) || $url==(request()->is(config('app.account').'/amount-withdraw/*')) || $url==(request()->is(config('app.account').'/amount-transfer/*')) || $url==(request()->is(config('app.account').'/bank-report/*')) || $url==config('app.or').'/receive-type' || $url==config('app.or').'/receive-sub-type' || $url==config('app.or').'/receive-voucher' || $url==config('app.op').'/payment-type' || $url==config('app.op').'/payment-sub-type' || $url==config('app.op').'/payment-voucher') ? 'active':''}}" id="account-tab" data-bs-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">
                            <i class="icon-dollar-sign"></i>
                            <span class="nav-link-text">Accounts</span>
                        </a>
                        <a class="nav-link {{($url==config('app.mc').'/customer' || $url==(request()->is(config('app.mc').'/customer-ledger/*')) || $url==config('app.mc').'/customer/create' || $url==(request()->is(config('app.mc').'/customer/*/edit')) || $url==config('app.em').'/employees' || $url==(request()->is(config('app.em').'/created-bill-list/*')) || $url==config('app.mc').'/floors' || $url==config('app.mc').'/market' || $url==config('app.mc').'/shop' || $url==config('app.mc').'/shop/create' || $url==config('app.mc').'/hostel-bill' || $url==config('app.mc').'/hostel-bill/create' || $url==(request()->is(config('app.mc').'/hostel-bill/*/edit')) || $url==config('app.mc').'/hostel-bill-payment' || $url==config('app.mc').'/hostel-bill-payment/create' || $url==(request()->is(config('app.mc').'/room-type/*/edit')) || $url==config('app.em').'/employee' || $url==(request()->is(config('app.em').'/employee-ledger/*')) || $url==(request()->is(config('app.mc').'/add-room-images/*')) || $url==config('app.em').'/employee-salary' || $url==config('app.em').'/designations' || $url==(request()->is(config('app.em').'/designations/*/edit'))) ? 'active':''}}" id="hotelconfiguration-tab" data-bs-toggle="tab" href="#tab-hotelconfiguration" role="tab" aria-controls="tab-hotelconfiguration" aria-selected="false">
                            <i class="icon-cog"></i>
                            <span class="nav-link-text">Market Configure</span>
                        </a>
                        <a class="nav-link {{($url==config('app.rent').'/project-type' || $url==config('app.rent').'/project-name' || $url==config('app.rent').'/apartments' || $url==config('app.rent').'/apartments/create' || $url==config('app.rent').'/apartment-assign' || $url==config('app.rent').'/apartment-assign/create' || $url==(request()->is(config('app.rent').'/apartment-assign/*/edit')) || $url==config('app.rent').'/hostel-bill' || $url==config('app.rent').'/hostel-bill/create' || $url==(request()->is(config('app.rent').'/hostel-bill/*/edit')) || $url==config('app.apartment').'/multiple-bill-payment' || $url==config('app.rent').'/bill-payment' || $url==config('app.rent').'/bill-payment/create' || $url==(request()->is(config('app.rent').'/bill-payment/*/edit')) || $url==config('app.rent').'/rent-list' || $url==config('app.rent').'/rent-list/create' || $url==(request()->is(config('app.rent').'/rent-list/*/edit')) || $url==config('app.rent').'/rent-bill' || $url==config('app.rent').'/rent-bill/create' || $url==(request()->is(config('app.rent').'/rent-bill/*/edit')) || $url==config('app.rent').'/rent-bill-payment' || $url==config('app.rent').'/multiple-rent-bill-payment' || $url==config('app.rent').'/bill-generate-at-a-time' || $url==(request()->is(config('app.rent').'/market-wise-shop-search/*')) || $url==config('app.rent').'/rent-bill-payment/create' || $url==config('app.rent').'/members' || $url==config('app.rent').'/members/create' || $url==(request()->is(config('app.rent').'/members/*/edit')) || $url==(request()->is(config('app.rent').'/member-ledger/*')) || $url==config('app.rent').'/customer-list-for-rent' || $url==(request()->is(config('app.rent').'/add-rent/*')) || $url==(request()->is(config('app.rent').'/rent-bill/create/*')) || $url==config('app.apartment').'/apartments' || $url==config('app.apartment').'/apartments/create' || $url==config('app.apartment').'/apartment-assign' || $url==config('app.apartment').'/apartment-assign/create' || $url==(request()->is(config('app.apartment').'/apartment-assign/*/edit')) || $url==config('app.apartment').'/bill' || $url==config('app.apartment').'/bill/create' || $url==(request()->is(config('app.apartment').'/bill/*/edit')) || $url==config('app.apartment').'/multiple-bill-payment' || $url==config('app.apartment').'/bill-payment' || $url==config('app.apartment').'/bill-payment/create' || $url==(request()->is(config('app.apartment').'/bill-payment/*/edit')) || $url==config('app.apartment').'/members' || $url==config('app.apartment').'/members/create' || $url==(request()->is(config('app.apartment').'/members/*/edit')) || $url==(request()->is(config('app.apartment').'/member-ledger/*')) || $url==config('app.apartment').'/projects' || $url==config('app.apartment').'/projects/create' || $url==(request()->is(config('app.apartment').'/projects/*/edit')) || $url==config('app.apartment').'/bill-create-at-a-time') ? 'active':''}}" id="apartment-tab" data-bs-toggle="tab" href="#tab-apartment" role="tab" aria-controls="tab-apartment" aria-selected="false">
                            <i class="icon-grid"></i>
                            <span class="nav-link-text">Rent</span>
                        </a>
                        <a class="nav-link {{($url==config('app.asset').'/assets' || $url==config('app.asset').'/asset-type' || $url==(request()->is(config('app.asset').'/asset-type/*/edit')) || $url==(request()->is(config('app.asset').'/assets/*/edit')) || $url==config('app.asset').'/asset-mamla' || $url==(request()->is(config('app.asset').'/asset-mamla/*/edit'))) ? 'active':''}}" id="assets-tab" data-bs-toggle="tab" href="#tab-assets" role="tab" aria-controls="tab-assets" aria-selected="false">
                            <i class="icon-brightness_auto"></i>
                            <span class="nav-link-text">Assets</span>
                        </a>
                        <a class="nav-link {{($url==config('app.temporary').'/raw-market' || $url==(request()->is(config('app.temporary').'/raw-market/*/edit')) || $url==config('app.temporary').'/collect-bill-report') ? 'active':''}}" id="temporaryKachaBazar-tab" data-bs-toggle="tab" href="#tab-temporaryKachaBazar" role="tab" aria-controls="tab-temporaryKachaBazar" aria-selected="false">
                            <i class="icon-grid_on"></i>
                            <span class="nav-link-text">Temporary Kacha bazar</span>
                        </a>
                        <a class="nav-link {{($url==config('app.madrasah').'/hafeez-list' || $url==config('app.madrasah').'/hafeez-list/create' || $url==(request()->is(config('app.madrasah').'/hafeez-list/*/edit')) || $url==config('app.madrasah').'/expense-type' || $url==(request()->is(config('app.madrasah').'/expense-type/*/edit')) || $url==config('app.madrasah').'/expense' || $url==config('app.madrasah').'/expense-report' || $url==config('app.madrasah').'/income-type' || $url==(request()->is(config('app.madrasah').'/income-type/*/edit')) || $url==config('app.madrasah').'/income' || $url==config('app.madrasah').'/income-report') ? 'active':''}}" id="hafeezManagement-tab" data-bs-toggle="tab" href="#tab-hafeezManagement" role="tab" aria-controls="tab-hafeezManagement" aria-selected="false">
                            <i class="icon-school"></i>
                            <span class="nav-link-text">Madrasah Management</span>
                        </a>
                        <a class="nav-link {{($url==config('app.hospital').'/hospital-expense-type' || $url==(request()->is(config('app.hospital').'/hospital-expense-type/*/edit')) || $url==config('app.hospital').'/hospital-expense' || $url==config('app.hospital').'/hospital-expense-report' || $url==config('app.hospital').'/hospital-income-type' || $url==(request()->is(config('app.hospital').'/hospital-income-type/*/edit')) || $url==config('app.hospital').'/hospital-income' || $url==config('app.hospital').'/hospital-income-report') ? 'active':''}}" id="hospitalManagement-tab" data-bs-toggle="tab" href="#tab-hospitalManagement" role="tab" aria-controls="tab-hospitalManagement" aria-selected="false">
                            <i class="icon-local_hospital"></i>
                            <span class="nav-link-text">Hospital Management</span>
                        </a>
                        <a class="nav-link {{($url==config('app.mosjid').'/mosjid-expense-type' || $url==(request()->is(config('app.mosjid').'/mosjid-expense-type/*/edit')) || $url==config('app.mosjid').'/mosjid-expense' || $url==config('app.mosjid').'/mosjid-expense-report' || $url==config('app.mosjid').'/mosjid-income-type' || $url==(request()->is(config('app.mosjid').'/mosjid-income-type/*/edit')) || $url==config('app.mosjid').'/mosjid-income' || $url==config('app.mosjid').'/mosjid-income-report') ? 'active':''}}" id="mosjidManagement-tab" data-bs-toggle="tab" href="#tab-mosjidManagement" role="tab" aria-controls="tab-mosjidManagement" aria-selected="false">
                            <i class="icon-school"></i>
                            <span class="nav-link-text">Mosjid Management</span>
                        </a>
                        <!-- <a class="nav-link {{($url==config('app.madrasah').'/hafeez-list' || $url==config('app.madrasah').'/hafeez-list/create' || $url==(request()->is(config('app.madrasah').'/hafeez-list/*/edit'))) ? 'active':''}}" id="hospitalManagement-tab" data-bs-toggle="tab" href="#tab-hospitalManagement" role="tab" aria-controls="tab-hafeezManagement" aria-selected="false">
                            <i class="icon-school"></i>
                            <span class="nav-link-text">Hospital Management</span>
                        </a> -->
                        <a class="nav-link {{($url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit'))) ? 'active':''}}" id="userconfiguration-tab" data-bs-toggle="tab" href="#tab-userconfiguration" role="tab" aria-controls="tab-userconfiguration" aria-selected="false">
                            <i class="icon-user"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                        <a class="nav-link settings" id="settings-tab" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-settings" aria-selected="false">
                            <i class="icon-settings1"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                    </div>
                    <!-- Tabs nav end -->

                    <!-- Tabs content start -->
                    <div class="tab-content">
                        <!-- Dasboard tab -->
                        <div class="tab-pane fade {{($url=='home' || $url==config('app.account').'/daily-transaction' || $url==config('app.account').'/final-report' || $url==config('app.or').'/receive-voucher-report' || $url==config('app.op').'/payment-voucher-report' || $url==config('app.hc').'/room-list-report' || $url==config('app.account').'/overall-income-report' || $url==config('app.account').'/overall-expense-report') ? 'show active':''}}" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Dashboard 
                            </div>
                            <!-- Tab content header end -->
                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{URL::To('home')}}" class="{{($url=='home') ? 'current-page':''}}">Dashboard</a>
                                        </li>
                                        <li class="list-heading">Reports</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.account').'/daily-transaction'}}"  class="{{($url==config('app.account').'/daily-transaction') ? 'current-page':''}}">Daily Transaction</a>
                                        </li>
                                        <!-- <li>
                                            <a href="{{$baseUrl.'/'.config('app.account').'/final-report'}}" class="{{($url==config('app.account').'/final-report') ? 'current-page':''}}">Final Balance</a>
                                        </li> -->
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.or').'/receive-voucher-report'}}" class="{{($url==config('app.or').'/receive-voucher-report') ? 'current-page':''}}">Income Voucher Report</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.op').'/payment-voucher-report'}}" class="{{($url==config('app.op').'/payment-voucher-report') ? 'current-page':''}}">Expense Voucher Report</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.account').'/overall-income-report'}}" class="{{($url==config('app.account').'/overall-income-report') ? 'current-page':''}}">Overall Income Report</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.account').'/overall-expense-report'}}" class="{{($url==config('app.account').'/overall-expense-report') ? 'current-page':''}}">Overall Expense Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Account tab -->
                        <div class="tab-pane fade {{($url==config('app.account').'/account-type' || $url==(request()->is(config('app.account').'/account-type/*/edit')) || $url==config('app.account').'/bank-account' || $url==config('app.account').'/cheque-book' || $url==config('app.account').'/cheque-no' || $url==(request()->is(config('app.account').'/bank-deposit/*')) || $url==(request()->is(config('app.account').'/amount-withdraw/*')) || $url==(request()->is(config('app.account').'/amount-transfer/*')) || $url==(request()->is(config('app.account').'/bank-report/*')) || $url==config('app.or').'/receive-type' || $url==config('app.or').'/receive-sub-type' || $url==config('app.or').'/receive-voucher' || $url==config('app.op').'/payment-type' || $url==config('app.op').'/payment-sub-type' || $url==config('app.op').'/payment-voucher') ? 'show active':''}}" id="tab-account" role="tabpanel" aria-labelledby="account-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Accounts
                            </div>
                            <!-- Tab content header end -->

                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-settings">
                                    <div class="accordion" id="bankAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="bankInfo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankCollapse" aria-expanded="true" aria-controls="bankCollapse">
                                                    Bank Accounts
                                                </button>
                                            </h2>
                                            <div id="bankCollapse" class="accordion-collapse collapse {{($url==config('app.account').'/account-type' || $url==(request()->is(config('app.account').'/account-type/*/edit')) || $url==config('app.account').'/bank-account' || $url==config('app.account').'/cheque-book' || $url==config('app.account').'/cheque-no' || $url==(request()->is(config('app.account').'/bank-deposit/*')) || $url==(request()->is(config('app.account').'/amount-withdraw/*')) || $url==(request()->is(config('app.account').'/amount-transfer/*')) || $url==(request()->is(config('app.account').'/bank-report/*'))) ? 'show':''}}" aria-labelledby="bankInfo" data-bs-parent="#bankAccordion">
                                                <div class="accordion-body">
                                                    <div class="sidebar-menu">
                                                        <ul>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.account').'/account-type'}}" class="{{($url==config('app.account').'/account-type' || $url==(request()->is(config('app.account').'/account-type/*/edit'))) ? 'current-page':''}}">Account Type</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.account').'/bank-account'}}" class="{{($url==config('app.account').'/bank-account' || $url==(request()->is(config('app.account').'/bank-deposit/*')) || $url==(request()->is(config('app.account').'/amount-withdraw/*')) || $url==(request()->is(config('app.account').'/amount-transfer/*')) || $url==(request()->is(config('app.account').'/bank-report/*'))) ? 'current-page':''}}">Bank Account</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.account').'/cheque-book'}}" class="{{($url==config('app.account').'/cheque-book') ? 'current-page':''}}">Cheque Book</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.account').'/cheque-no'}}" class="{{($url==config('app.account').'/cheque-no') ? 'current-page':''}}">Cheque No</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="otherReceiveInfo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#otherReceiveCollapse" aria-expanded="true" aria-controls="otherReceiveCollapse">
                                                    Income
                                                </button>
                                            </h2>
                                            <div id="otherReceiveCollapse" class="accordion-collapse collapse {{($url==config('app.or').'/receive-type' || $url==config('app.or').'/receive-sub-type' || $url==config('app.or').'/receive-voucher') ? 'show':''}}" aria-labelledby="otherReceiveInfo" data-bs-parent="#bankAccordion">
                                                <div class="accordion-body">
                                                    <div class="sidebar-menu">
                                                        <ul>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-type'}}" class="{{($url==config('app.or').'/receive-type') ? 'current-page':''}}">Income Type</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-sub-type'}}" class="{{($url==config('app.or').'/receive-sub-type') ? 'current-page':''}}">Income Sub Type</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-voucher'}}" class="{{($url==config('app.or').'/receive-voucher') ? 'current-page':''}}">Income Voucher</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="otherPaymentInfo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#otherPaymentCollapse" aria-expanded="true" aria-controls="otherPaymentCollapse">
                                                    Expense
                                                </button>
                                            </h2>
                                            <div id="otherPaymentCollapse" class="accordion-collapse collapse {{($url==config('app.op').'/payment-type' || $url==config('app.op').'/payment-sub-type' || $url==config('app.op').'/payment-voucher') ? 'show':''}}" aria-labelledby="otherPaymentInfo" data-bs-parent="#bankAccordion">
                                                <div class="accordion-body">
                                                    <div class="sidebar-menu">
                                                        <ul>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-type'}}" class="{{($url==config('app.op').'/payment-type') ? 'current-page':''}}">Expense Type</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-sub-type'}}" class="{{($url==config('app.op').'/payment-sub-type') ? 'current-page':''}}">Expense Sub Type</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-voucher'}}" class="{{($url==config('app.op').'/payment-voucher') ? 'current-page':''}}">Expense Voucher</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Hotel Configuration tab -->
                        <div class="tab-pane fade {{($url==config('app.mc').'/customer' || $url==(request()->is(config('app.mc').'/customer-ledger/*')) || $url==config('app.mc').'/customer/create' || $url==(request()->is(config('app.mc').'/customer/*/edit')) || $url==config('app.mc').'/market' || $url==config('app.mc').'/floors' || $url==config('app.mc').'/shop' || $url==config('app.mc').'/shop/create' || $url==config('app.mc').'/hostel-bill' || $url==config('app.mc').'/hostel-bill/create' || $url==(request()->is(config('app.mc').'/hostel-bill/*/edit')) || $url==config('app.mc').'/hostel-bill-payment' || $url==config('app.mc').'/hostel-bill-payment/create' || $url==config('app.em').'/employees' || $url==config('app.em').'/all-bill-list' || $url==(request()->is(config('app.em').'/created-bill-list/*')) || $url==(request()->is(config('app.em').'/employee-ledger/*')) || $url==(request()->is(config('app.mc').'/add-room-images/*')) || $url==config('app.em').'/employee-salary' || $url==config('app.em').'/designations' || $url==(request()->is(config('app.em').'/designations/*/edit')) || $url==config('app.mc').'/donor-list' || $url==config('app.mc').'/donor-list/create' || $url==(request()->is(config('app.mc').'/donor-list/*/edit')) || $url==(request()->is(config('app.mc').'/donor-ledger/*'))) ? 'show active':''}}" id="tab-hotelconfiguration" role="tabpanel" aria-labelledby="hotelconfiguration-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Market Configure
                            </div>
                            <!-- Tab content header end -->

                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mc').'/customer'}}" class="{{($url==config('app.mc').'/customer' || $url==config('app.mc').'/customer/create' || $url==(request()->is(config('app.mc').'/customer/*/edit')) || $url==(request()->is(config('app.mc').'/customer-ledger/*'))) ? 'current-page':''}}">Customer</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mc').'/market'}}" class="{{($url==config('app.mc').'/market') ? 'current-page':''}}">Market</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mc').'/floors'}}" class="{{($url==config('app.mc').'/floors') ? 'current-page':''}}">Floors</a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mc').'/shop'}}" class="{{($url==config('app.mc').'/shop' || $url==config('app.mc').'/shop/create' || $url==(request()->is(config('app.mc').'/add-room-images/*'))) ? 'current-page':''}}">Shop</a>
                                        </li>
                                        <li class="list-heading">Employee</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.em').'/designations'}}" class="{{($url==config('app.em').'/designations' || $url==(request()->is(config('app.em').'/designations/*/edit'))) ? 'current-page':''}}">Designation</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.em').'/employees'}}" class="{{($url==config('app.em').'/employees' || $url==(request()->is(config('app.em').'/employee-ledger/*')) || $url==(request()->is(config('app.em').'/created-bill-list/*'))) ? 'current-page':''}}">Employee</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.em').'/all-bill-list'}}" class="{{($url==config('app.em').'/all-bill-list') ? 'current-page':''}}">Bill List</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.em').'/employee-salary'}}" class="{{($url==config('app.em').'/employee-salary') ? 'current-page':''}}">Employee Salary Report</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mc').'/donor-list'}}" class="{{($url==config('app.mc').'/donor-list' || $url==config('app.mc').'/donor-list/create' || $url==(request()->is(config('app.mc').'/donor-list/*/edit')) || $url==(request()->is(config('app.mc').'/donor-ledger/*'))) ? 'current-page':''}}">Donor List</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Apartment Configuration tab -->
                        <div class="tab-pane fade {{($url==config('app.rent').'/project-type' || $url==config('app.rent').'/project-name' || $url==config('app.rent').'/apartments' || $url==config('app.rent').'/apartments/create' || $url==config('app.rent').'/apartment-assign' || $url==config('app.rent').'/apartment-assign/create' || $url==(request()->is(config('app.rent').'/apartment-assign/*/edit')) || $url==config('app.rent').'/bill' || $url==config('app.rent').'/bill/create' || $url==(request()->is(config('app.rent').'/bill/*/edit')) || $url==config('app.rent').'/bill-payment' || $url==config('app.rent').'/bill-payment/create' || $url==(request()->is(config('app.rent').'/bill-payment/*/edit')) || $url==config('app.rent').'/rent-list' || $url==config('app.rent').'/rent-list/create' || $url==(request()->is(config('app.rent').'/rent-list/*/edit')) || $url==config('app.rent').'/rent-bill'|| $url==config('app.rent').'/rent-bill/create' || $url==(request()->is(config('app.rent').'/rent-bill/*/edit')) || $url==config('app.rent').'/rent-bill-payment' || $url==config('app.rent').'/multiple-rent-bill-payment' || $url==config('app.rent').'/bill-generate-at-a-time' || $url==config('app.apartment').'/bill-create-at-a-time' || $url==(request()->is(config('app.rent').'/market-wise-shop-search/*')) || $url==config('app.rent').'/rent-bill-payment/create' || $url==config('app.rent').'/members' || $url==config('app.rent').'/members/create' || $url==(request()->is(config('app.rent').'/members/*/edit')) || $url==(request()->is(config('app.rent').'/member-ledger/*')) || $url==config('app.rent').'/customer-list-for-rent' || $url==(request()->is(config('app.rent').'/add-rent/*')) || $url==(request()->is(config('app.rent').'/rent-bill/create/*')) || $url==config('app.apartment').'/apartments' || $url==config('app.apartment').'/apartments/create' || $url==config('app.apartment').'/apartment-assign' || $url==config('app.apartment').'/apartment-assign/create' || $url==(request()->is(config('app.apartment').'/apartment-assign/*/edit')) || $url==config('app.apartment').'/bill' || $url==config('app.apartment').'/bill/create' || $url==(request()->is(config('app.apartment').'/bill/*/edit')) || $url==config('app.apartment').'/multiple-bill-payment' || $url==config('app.apartment').'/bill-payment' || $url==config('app.apartment').'/bill-payment/create' || $url==(request()->is(config('app.apartment').'/bill-payment/*/edit')) || $url==config('app.apartment').'/members' || $url==config('app.apartment').'/members/create' || $url==(request()->is(config('app.apartment').'/members/*/edit')) || $url==(request()->is(config('app.apartment').'/member-ledger/*')) || $url==config('app.apartment').'/projects' || $url==config('app.apartment').'/projects/create' || $url==(request()->is(config('app.apartment').'/projects/*/edit'))) ? 'show active':''}}" id="tab-apartment" role="tabpanel" aria-labelledby="apartment-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Rent
                            </div>
                            <!-- Tab content header end -->
                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-settings">
                                    <div class="accordion" id="rentFromOwner">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="rentFromOwnerInfo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#rentFromOwnerCollapse" aria-expanded="true" aria-controls="rentFromOwnerCollapse">
                                                    Rent Shop
                                                </button>
                                            </h2>
                                            <div id="rentFromOwnerCollapse" class="accordion-collapse collapse {{($url==config('app.rent').'/rent-list' || $url==config('app.rent').'/rent-list/create' || $url==(request()->is(config('app.rent').'/rent-list/*/edit')) || $url==config('app.rent').'/rent-bill' || $url==config('app.rent').'/rent-bill/create' || $url==(request()->is(config('app.rent').'/rent-bill/*/edit')) || $url==config('app.rent').'/rent-bill-payment' || $url==config('app.rent').'/multiple-rent-bill-payment' || $url==config('app.rent').'/bill-generate-at-a-time' || $url==(request()->is(config('app.rent').'/market-wise-shop-search/*')) || $url==config('app.rent').'/rent-bill-payment/create' || $url==config('app.rent').'/customer-list-for-rent' || $url==(request()->is(config('app.rent').'/add-rent/*')) || $url==(request()->is(config('app.rent').'/rent-bill/create/*'))) ? 'show':''}}" aria-labelledby="rentFromOwnerInfo" data-bs-parent="#rentFromOwner">
                                                <div class="accordion-body">
                                                    <div class="sidebar-menu">
                                                        <ul>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.rent').'/customer-list-for-rent'}}" class="{{($url==config('app.rent').'/customer-list-for-rent' || $url==(request()->is(config('app.rent').'/add-rent/*'))) ? 'current-page':''}}">Add Rent</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.rent').'/rent-list'}}" class="{{($url==config('app.rent').'/rent-list' || $url==config('app.rent').'/rent-list/create' || $url==(request()->is(config('app.rent').'/rent-list/*/edit')) || $url==(request()->is(config('app.rent').'/rent-bill/create/*'))) ? 'current-page':''}}">Rent List</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.rent').'/rent-bill'}}" class="{{($url==config('app.rent').'/rent-bill' || $url==config('app.rent').'/rent-bill/create' || $url==(request()->is(config('app.rent').'/rent-bill/*/edit'))) ? 'current-page':''}}">Generated Bill List</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.rent').'/bill-generate-at-a-time'}}" class="{{($url==config('app.rent').'/bill-generate-at-a-time' || $url==(request()->is(config('app.rent').'/market-wise-shop-search/*'))) ? 'current-page':''}}">Multiple Bill Generate</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.rent').'/rent-bill-payment'}}" class="{{($url==config('app.rent').'/rent-bill-payment' || $url==config('app.rent').'/rent-bill-payment/create') ? 'current-page':''}}">Bill Collection</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.rent').'/multiple-rent-bill-payment'}}" class="{{($url==config('app.rent').'/multiple-rent-bill-payment') ? 'current-page':''}}">Multiple Bill Collection</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="rentToMemberInfo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#rentToMemberCollapse" aria-expanded="true" aria-controls="rentToMemberCollapse">
                                                    Apartment Rent
                                                </button>
                                            </h2>
                                            <div id="rentToMemberCollapse" class="accordion-collapse collapse {{($url==config('app.apartment').'/project-type' || $url==config('app.apartment').'/project-name' || $url==config('app.apartment').'/apartments' || $url==config('app.apartment').'/apartments/create' || $url==config('app.apartment').'/apartment-assign' || $url==config('app.apartment').'/apartment-assign/create' || $url==(request()->is(config('app.apartment').'/apartment-assign/*/edit')) || $url==config('app.apartment').'/bill' || $url==config('app.apartment').'/bill/create' || $url==(request()->is(config('app.apartment').'/bill/*/edit')) || $url==config('app.apartment').'/multiple-bill-payment' || $url==config('app.apartment').'/bill-payment' || $url==config('app.apartment').'/bill-payment/create' || $url==(request()->is(config('app.apartment').'/bill-payment/*/edit')) || $url==config('app.apartment').'/members' || $url==config('app.apartment').'/members/create' || $url==(request()->is(config('app.apartment').'/members/*/edit')) || $url==(request()->is(config('app.apartment').'/member-ledger/*')) || $url==config('app.apartment').'/projects' || $url==config('app.apartment').'/projects/create' || $url==(request()->is(config('app.apartment').'/projects/*/edit')) || $url==config('app.apartment').'/bill-create-at-a-time') ? 'show':''}}" aria-labelledby="rentToMemberInfo" data-bs-parent="#rentToMember">
                                                <div class="accordion-body">
                                                    <div class="sidebar-menu">
                                                        <ul>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/members'}}" class="{{($url==config('app.apartment').'/members' || $url==config('app.apartment').'/members/create' || $url==(request()->is(config('app.apartment').'/members/*/edit')) || $url==(request()->is(config('app.apartment').'/member-ledger/*'))) ? 'current-page':''}}">Apartment Member</a>
                                                            </li>
                                                            <!-- <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/project-type'}}" class="{{($url==config('app.apartment').'/project-type') ? 'current-page':''}}">Project Type</a>
                                                            </li> -->
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/projects'}}" class="{{($url==config('app.apartment').'/projects' || $url==(request()->is(config('app.apartment').'/projects/*/edit')) || $url==config('app.apartment').'/projects/create') ? 'current-page':''}}">Project Name</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/apartments'}}" class="{{($url==config('app.apartment').'/apartments' || $url==config('app.apartment').'/apartments/create') ? 'current-page':''}}">Apartment</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/apartment-assign'}}" class="{{($url==config('app.apartment').'/apartment-assign' || $url==config('app.apartment').'/apartment-assign/create' || $url==(request()->is(config('app.apartment').'/apartment-assign/*/edit'))) ? 'current-page':''}}">Assign Apartment</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/bill'}}" class="{{($url==config('app.apartment').'/bill' || $url==config('app.apartment').'/bill/create' || $url==(request()->is(config('app.apartment').'/bill/*/edit'))) ? 'current-page':''}}">Bill Generate</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/bill-create-at-a-time'}}" class="{{($url==config('app.apartment').'/bill-create-at-a-time' || $url==(request()->is(config('app.apartment').'/market-wise-shop-search/*'))) ? 'current-page':''}}">Multiple Bill Generate</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/bill-payment'}}" class="{{($url==config('app.apartment').'/bill-payment' || $url==config('app.apartment').'/bill-payment/create') ? 'current-page':''}}">Bill Collection</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{$baseUrl.'/'.config('app.apartment').'/multiple-bill-payment'}}" class="{{($url==config('app.apartment').'/multiple-bill-payment' || $url==config('app.apartment').'/multiple-bill-payment/create') ? 'current-page':''}}">Multiple Bill Collection</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- assets Configuration tab -->
                        <div class="tab-pane fade {{($url==config('app.asset').'/assets' || $url==config('app.asset').'/asset-type' || $url==(request()->is(config('app.asset').'/asset-type/*/edit')) || $url==(request()->is(config('app.asset').'/assets/*/edit')) || $url==config('app.asset').'/asset-mamla' || $url==(request()->is(config('app.asset').'/asset-mamla/*/edit'))) ? 'show active':''}}" id="tab-assets" role="tabpanel" aria-labelledby="apartment-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Assets
                            </div>
                            <!-- Tab content header end -->
                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.asset').'/asset-type'}}" class="{{($url==config('app.asset').'/asset-type' || $url==config('app.asset').'/asset-type/create' || $url==(request()->is(config('app.asset').'/asset-type/*/edit'))) ? 'current-page':''}}">Asset Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.asset').'/assets'}}" class="{{($url==config('app.asset').'/assets' || $url==config('app.asset').'/assets/create' || $url==(request()->is(config('app.asset').'/assets/*/edit'))) ? 'current-page':''}}">Assets</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.asset').'/asset-mamla'}}" class="{{($url==config('app.asset').'/asset-mamla' || $url==config('app.asset').'/asset-mamla/create' || $url==(request()->is(config('app.asset').'/asset-mamla/*/edit'))) ? 'current-page':''}}">Asset Mamla</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Kacha Bazra Configuration tab -->
                        <div class="tab-pane fade {{($url==config('app.temporary').'/raw-market' || $url==(request()->is(config('app.temporary').'/raw-market/*/edit')) || $url==config('app.temporary').'/collect-bill' || $url==config('app.temporary').'/collect-bill-report') ? 'show active':''}}" id="tab-temporaryKachaBazar" role="tabpanel" aria-labelledby="temporaryKachaBazar-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Temporary Kacha Bazar
                            </div>
                            <!-- Tab content header end -->
                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.temporary').'/raw-market'}}" class="{{($url==config('app.temporary').'/raw-market' || $url==config('app.temporary').'/raw-market/create' || $url==(request()->is(config('app.temporary').'/raw-market/*/edit'))) ? 'current-page':''}}">Rent List</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.temporary').'/collect-bill'}}" class="{{($url==config('app.temporary').'/collect-bill' || $url==config('app.temporary').'/collect-bill/create' || $url==(request()->is(config('app.temporary').'/collect-bill/*/edit'))) ? 'current-page':''}}">Collect Bill</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.temporary').'/collect-bill-report'}}" class="{{($url==config('app.temporary').'/collect-bill-report') ? 'current-page':''}}">Collect Bill Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Madrasah tab -->
                        <div class="tab-pane fade {{($url==config('app.madrasah').'/hafeez-list' || $url==config('app.madrasah').'/hafeez-list/create' || $url==(request()->is(config('app.madrasah').'/hafeez-list/*/edit')) || $url==config('app.madrasah').'/expense' || $url==config('app.madrasah').'/expense-type' || $url==(request()->is(config('app.madrasah').'/expense-type/*/edit')) || $url==config('app.madrasah').'/income' || $url==config('app.madrasah').'/income-type' || $url==config('app.madrasah').'/expense-report' || $url==config('app.madrasah').'/income-report') ? 'show active':''}}" id="tab-hafeezManagement" role="tabpanel" aria-labelledby="hafeezManagement-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Madrasah Management
                            </div>
                            <!-- Tab content header end -->

                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/hafeez-list'}}" class="{{($url==config('app.madrasah').'/hafeez-list' || $url==config('app.madrasah').'/hafeez-list/create' || $url==(request()->is(config('app.madrasah').'/hafeez-list/*/edit'))) ? 'current-page':''}}">Hafeez List</a>
                                        </li>
                                        <li class="list-heading">Expense</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/expense-type'}}" class="{{($url==config('app.madrasah').'/expense-type' || $url==config('app.madrasah').'/expense-type/create' || $url==(request()->is(config('app.madrasah').'/expense-type/*/edit'))) ? 'current-page':''}}">Expense Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/expense'}}" class="{{($url==config('app.madrasah').'/expense' || $url==config('app.madrasah').'/expense/create' || $url==(request()->is(config('app.madrasah').'/expense/*/edit'))) ? 'current-page':''}}">Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/expense-report'}}" class="{{($url==config('app.madrasah').'/expense-report' || $url==config('app.madrasah').'/expense-report/create' || $url==(request()->is(config('app.madrasah').'/expense-report/*/edit'))) ? 'current-page':''}}">Expense Report</a>
                                        </li>
                                        <li class="list-heading">Income</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/income-type'}}" class="{{($url==config('app.madrasah').'/income-type' || $url==config('app.madrasah').'/income-type/create' || $url==(request()->is(config('app.madrasah').'/income-type/*/edit'))) ? 'current-page':''}}">Income Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/income'}}" class="{{($url==config('app.madrasah').'/income' || $url==config('app.madrasah').'/income/create' || $url==(request()->is(config('app.madrasah').'/income/*/edit'))) ? 'current-page':''}}">Income</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.madrasah').'/income-report'}}" class="{{($url==config('app.madrasah').'/income-report' || $url==config('app.madrasah').'/income-report/create' || $url==(request()->is(config('app.madrasah').'/income-report/*/edit'))) ? 'current-page':''}}">Income Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Hospital tab -->
                        <div class="tab-pane fade {{($url==config('app.hospital').'/hospital-expense' || $url==config('app.hospital').'/hospital-expense-type' || $url==(request()->is(config('app.hospital').'/expense-type/*/edit')) || $url==config('app.hospital').'/hospital-income' || $url==config('app.hospital').'/hospital-income-type' || $url==config('app.hospital').'/hospital-expense-report' || $url==config('app.hospital').'/hospital-income-report') ? 'show active':''}}" id="tab-hospitalManagement" role="tabpanel" aria-labelledby="hospitalManagement-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Hospital Management
                            </div>
                            <!-- Tab content header end -->

                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li class="list-heading">Expense</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hospital').'/hospital-expense-type'}}" class="{{($url==config('app.hospital').'/hospital-expense-type' || $url==config('app.hospital').'/hospital-expense-type/create' || $url==(request()->is(config('app.hospital').'/hospital-expense-type/*/edit'))) ? 'current-page':''}}">Expense Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hospital').'/hospital-expense'}}" class="{{($url==config('app.hospital').'/hospital-expense') ? 'current-page':''}}">Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hospital').'/hospital-expense-report'}}" class="{{($url==config('app.hospital').'/hospital-expense-report') ? 'current-page':''}}">Expense Report</a>
                                        </li>
                                        <li class="list-heading">Income</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hospital').'/hospital-income-type'}}" class="{{($url==config('app.hospital').'/hospital-income-type' || $url==config('app.hospital').'/hospital-income-type/create' || $url==(request()->is(config('app.hospital').'/hospital-income-type/*/edit'))) ? 'current-page':''}}">Income Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hospital').'/hospital-income'}}" class="{{($url==config('app.hospital').'/hospital-income') ? 'current-page':''}}">Income</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hospital').'/hospital-income-report'}}" class="{{($url==config('app.hospital').'/hospital-income-report') ? 'current-page':''}}">Income Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- Mosjid tab -->
                        <div class="tab-pane fade {{($url==config('app.mosjid').'/mosjid-expense' || $url==config('app.mosjid').'/mosjid-expense-type' || $url==(request()->is(config('app.mosjid').'/expense-type/*/edit')) || $url==config('app.mosjid').'/mosjid-income' || $url==config('app.mosjid').'/mosjid-income-type' || $url==config('app.mosjid').'/mosjid-expense-report' || $url==config('app.mosjid').'/mosjid-income-report') ? 'show active':''}}" id="tab-mosjidManagement" role="tabpanel" aria-labelledby="hospitalManagement-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Mosjid Management
                            </div>
                            <!-- Tab content header end -->

                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li class="list-heading">Expense</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mosjid').'/mosjid-expense-type'}}" class="{{($url==config('app.mosjid').'/mosjid-expense-type' || $url==config('app.mosjid').'/mosjid-expense-type/create' || $url==(request()->is(config('app.mosjid').'/mosjid-expense-type/*/edit'))) ? 'current-page':''}}">Expense Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mosjid').'/mosjid-expense'}}" class="{{($url==config('app.mosjid').'/mosjid-expense') ? 'current-page':''}}">Expense</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mosjid').'/mosjid-expense-report'}}" class="{{($url==config('app.mosjid').'/mosjid-expense-report') ? 'current-page':''}}">Expense Report</a>
                                        </li>
                                        <li class="list-heading">Income</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mosjid').'/mosjid-income-type'}}" class="{{($url==config('app.mosjid').'/mosjid-income-type' || $url==config('app.mosjid').'/mosjid-income-type/create' || $url==(request()->is(config('app.mosjid').'/mosjid-income-type/*/edit'))) ? 'current-page':''}}">Income Type</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mosjid').'/mosjid-income'}}" class="{{($url==config('app.mosjid').'/mosjid-income') ? 'current-page':''}}">Income</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.mosjid').'/mosjid-income-report'}}" class="{{($url==config('app.mosjid').'/mosjid-income-report') ? 'current-page':''}}">Income Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>

                        <!-- User Configuration tab -->
                        <div class="tab-pane fade {{($url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit'))) ? 'show active':''}}" id="tab-userconfiguration" role="tabpanel" aria-labelledby="userconfiguration-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Users
                            </div>
                            <!-- Tab content header end -->

                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.user').'/user-list'}}" class="{{($url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit'))) ? 'current-page':''}}">Users</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>                        
                        
                        <!-- Settings tab -->
                        <div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="settings-tab">
                            
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Settings
                            </div>
                            <!-- Tab content header end -->

                            <!-- Settings start -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-settings">
                                    <div class="accordion" id="settingsAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="siteSettingInfo">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#siteSettingCollapse" aria-expanded="true" aria-controls="siteSettingCollapse">
                                                    Site Setting
                                                </button>
                                            </h2>
                                            <div id="siteSettingCollapse" class="accordion-collapse collapse show" aria-labelledby="siteSettingInfo" data-bs-parent="#settingsAccordion">
                                                <div class="accordion-body">
                                                    {!! Form::open(array('route' =>['save-site-setting',1],'method'=>'PUT')) !!}
                                                    <?php 
                                                        $siteSetting = DB::table('site_setting')->where('id', 1)->first();
                                                    ?>
                                                    <div class="field-wrapper">
                                                        <input type="text" value="{{$siteSetting->site_page_title}}" name="site_page_title"/>
                                                        <div class="field-placeholder">Site Page Title</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="text" value="{{$siteSetting->hotel_name}}" name="hotel_name"/>
                                                        <div class="field-placeholder">Hotel Name</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="email" value="{{$siteSetting->hotel_email}}" name="hotel_email" />
                                                        <div class="field-placeholder">Hotel Email</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="text" value="{{$siteSetting->hotel_phone}}" name="hotel_phone" />
                                                        <div class="field-placeholder">Hotel Phone</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="text" value="{{$siteSetting->hotel_website}}" name="hotel_website" />
                                                        <div class="field-placeholder">Hotel Website</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <textarea name="hotel_address">{{$siteSetting->hotel_address}}</textarea>
                                                        <div class="field-placeholder">Hotel Address</div>
                                                    </div>
                                                    <div class="field-wrapper m-0">
                                                        <button class="btn btn-primary stripes-btn" type="submit">Save</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="currencyInfo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#currencyCollapse" aria-expanded="false" aria-controls="currencyCollapse">
                                                    Currency
                                                </button>
                                            </h2>
                                            <div id="currencyCollapse" class="accordion-collapse collapse" aria-labelledby="currencyInfo" data-bs-parent="#settingsAccordion">
                                                <div class="accordion-body">
                                                    {!! Form::open(array('route' =>['save-currency-setting',1],'method'=>'PUT')) !!}
                                                    <?php 
                                                        $currencyInfo = DB::table('currency')->where('id', 1)->first();
                                                    ?>
                                                    <div class="field-wrapper">
                                                        <input type="text" value="{{$currencyInfo->currency}}" name="currency">
                                                        <div class="field-placeholder">Currency</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="text" value="{{$currencyInfo->symbol}}" name="symbol">
                                                        <div class="field-placeholder">Currency Symbol</div>
                                                    </div>
                                                    <div class="field-wrapper m-0">
                                                        <button class="btn btn-primary stripes-btn">Save</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="chngPwd">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#chngPwdCollapse" aria-expanded="false" aria-controls="chngPwdCollapse">
                                                    Change Password
                                                </button>
                                            </h2>
                                            <div id="chngPwdCollapse" class="accordion-collapse collapse" aria-labelledby="chngPwd" data-bs-parent="#settingsAccordion">
                                                <div class="accordion-body">
                                                    {!! Form::open(array('route' =>['update-user-password',Auth::user()->id],'method'=>'PUT')) !!}
                                                    <div class="field-wrapper">
                                                        <input type="password" value="" name="password" id="newPass" class="keyup">
                                                        <div class="field-placeholder">New Password</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="password" value="" name="password_confirmation" id="confirmPass" class="keyup">
                                                        <div class="field-placeholder">Confirm Password</div>
                                                        <span id="confirmMsg"></span>
                                                    </div>
                                                    <div class="field-wrapper m-0">
                                                        <button class="btn btn-primary stripes-btn">Save</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="chngTheme">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#chngThemeCollapse" aria-expanded="false" aria-controls="chngThemeCollapse">
                                                    Theme Setting
                                                </button>
                                            </h2>
                                            <div id="chngThemeCollapse" class="accordion-collapse collapse" aria-labelledby="chngTheme" data-bs-parent="#settingsAccordion">
                                                <div class="accordion-body">
                                                    {!! Form::open(array('route' =>['update-site-theme',Auth::user()->id],'method'=>'PUT')) !!}
                                                    <div class="field-wrapper">
                                                        <select class="form-control" name="theme_id">
                                                            <?php 
                                                                $themeColor = ['1'=>'Blue', '2'=>'Dark', '3'=>'Green', '4'=>'Red', '5'=>'Violet'];
                                                            ?>
                                                            @foreach($themeColor as $key=>$value)
                                                            <option value="{{$key}}" {{($checkThemeforUser->theme_id==$key)?'selected':''}}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="field-placeholder">Selected Theme</div>
                                                    </div>
                                                    <div class="field-wrapper m-0">
                                                        <button class="btn btn-primary stripes-btn">Save</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Settings end -->
                        </div>

                    </div>
                    <!-- Tabs content end -->
                    @endif

                    @if(Auth::user()->user_type == 4 || Auth::user()->user_type == 5)
                    <!-- Tabs nav start -->
                    <div class="nav" role="tablist" aria-orientation="vertical">
                        <a href="{{URL::To('home')}}" class="logo">
                            <img src="{{asset('custom/img/logo.svg')}}" alt="Uni Pro Admin">
                        </a>
                        <a class="nav-link {{($url=='home' || $url==config('app.restaurant').'/sell-report' || $url==config('app.hc').'/member' || $url==(request()->is(config('app.hc').'/member/*/edit')) || $url==(request()->is(config('app.hc').'/member-ledger/*'))) ? 'active':''}}" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab" aria-controls="tab-home" aria-selected="true">
                            <i class="icon-home2"></i>
                            <span class="nav-link-text">Dashboard </span>
                        </a>
                        <a class="nav-link {{($url==config('app.restaurant').'/token-confirmation' || $url==config('app.restaurant').'/token-request-report') ? 'active':''}}" id="token-tab" data-bs-toggle="tab" href="#tab-token" role="tab" aria-controls="tab-token" aria-selected="true">
                            <i class="icon-home2"></i>
                            <span class="nav-link-text">Token Confirmation </span>
                        </a>
                        <a class="nav-link settings" id="settings-tab" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-settings" aria-selected="false">
                            <i class="icon-settings1"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                    </div>
                    <!-- Tabs nav end -->

                    <!-- Tabs content start -->
                    <div class="tab-content">
                        <!-- Dasboard tab -->
                        <div class="tab-pane fade {{($url=='home' || $url==config('app.restaurant').'/sell-report' || $url==config('app.hc').'/member' || $url==(request()->is(config('app.hc').'/member/*/edit')) || $url==(request()->is(config('app.hc').'/member-ledger/*'))) ? 'show active':''}}" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Dashboard 
                            </div>
                            <!-- Tab content header end -->
                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{URL::To('home')}}" class="{{($url=='home') ? 'current-page':''}}">Dashboard</a>
                                        </li>
                                        <li class="list-heading">Reports</li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.restaurant').'/sell-report'}}" class="{{($url==config('app.restaurant').'/sell-report' || $url==(request()->is(config('app.restaurant').'/sell-invoice/*'))) ? 'current-page':''}}">Package Purchase Report</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.hc').'/member'}}" class="{{($url==config('app.hc').'/member' || $url==(request()->is(config('app.hc').'/member/*/edit')) || $url==(request()->is(config('app.hc').'/member-ledger/*'))) ? 'current-page':''}}">Profile</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>  

                        <!-- Dasboard tab -->
                        <div class="tab-pane fade {{($url==config('app.restaurant').'/token-confirmation' || $url==config('app.restaurant').'/token-request-report') ? 'show active':''}}" id="tab-token" role="tabpanel" aria-labelledby="token-tab">
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Token Confirmation 
                            </div>
                            <!-- Tab content header end -->
                            <!-- Sidebar menu starts -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.restaurant').'/token-confirmation'}}" class="{{($url==config('app.restaurant').'/token-confirmation') ? 'current-page':''}}">Token Confirmation Form</a>
                                        </li>
                                        <li>
                                            <a href="{{$baseUrl.'/'.config('app.restaurant').'/token-request-report'}}" class="{{($url==config('app.restaurant').'/token-request-report') ? 'current-page':''}}">Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar menu ends -->
                        </div>                    
                        
                        <!-- Settings tab -->
                        <div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="settings-tab">
                            
                            <!-- Tab content header start -->
                            <div class="tab-pane-header">
                                Settings
                            </div>
                            <!-- Tab content header end -->

                            <!-- Settings start -->
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-settings">
                                    <div class="accordion" id="settingsAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="chngPwd">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#chngPwdCollapse" aria-expanded="false" aria-controls="chngPwdCollapse">
                                                    Change Password
                                                </button>
                                            </h2>
                                            <div id="chngPwdCollapse" class="accordion-collapse collapse" aria-labelledby="chngPwd" data-bs-parent="#settingsAccordion">
                                                <div class="accordion-body">
                                                    {!! Form::open(array('route' =>['update-user-password',Auth::user()->id],'method'=>'PUT')) !!}
                                                    <div class="field-wrapper">
                                                        <input type="password" value="" name="password" id="newPass" class="keyup">
                                                        <div class="field-placeholder">New Password</div>
                                                    </div>
                                                    <div class="field-wrapper">
                                                        <input type="password" value="" name="password_confirmation" id="confirmPass" class="keyup">
                                                        <div class="field-placeholder">Confirm Password</div>
                                                        <span id="confirmMsg"></span>
                                                    </div>
                                                    <div class="field-wrapper m-0">
                                                        <button class="btn btn-primary stripes-btn">Save</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="chngTheme">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#chngThemeCollapse" aria-expanded="false" aria-controls="chngThemeCollapse">
                                                    Theme Setting
                                                </button>
                                            </h2>
                                            <div id="chngThemeCollapse" class="accordion-collapse collapse" aria-labelledby="chngTheme" data-bs-parent="#settingsAccordion">
                                                <div class="accordion-body">
                                                    {!! Form::open(array('route' =>['update-site-theme',Auth::user()->id],'method'=>'PUT')) !!}
                                                    <div class="field-wrapper">
                                                        <select class="form-control" name="theme_id">
                                                            <?php 
                                                                $themeColor = ['1'=>'Blue', '2'=>'Dark', '3'=>'Green', '4'=>'Red', '5'=>'Violet'];
                                                            ?>
                                                            @foreach($themeColor as $key=>$value)
                                                            <option value="{{$key}}" {{($checkThemeforUser->theme_id==$key)?'selected':''}}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="field-placeholder">Selected Theme</div>
                                                    </div>
                                                    <div class="field-wrapper m-0">
                                                        <button class="btn btn-primary stripes-btn">Save</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Settings end -->

                            <!-- Sidebar actions starts -->
                            <div class="sidebar-actions">
                                <div class="support-tile blue">
                                    <a href="account-settings.html" class="btn btn-light m-auto">Advance Settings</a>
                                </div>
                            </div>
                            <!-- Sidebar actions ends -->
                        </div>

                    </div>
                    <!-- Tabs content end -->
                    @endif
                </div>
                <!-- Sidebar content end -->
                
            </nav>
            <!-- Sidebar wrapper end -->

            <!-- ************* ************ Main container start ************************** -->
            <div class="main-container"> 
                <!-- Page header starts -->
                <div class="page-header">
                    
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">

                            <!-- Search container start -->
                            <div class="search-container">

                                <!-- Toggle sidebar start -->
                                <div class="toggle-sidebar" id="toggle-sidebar">
                                    <i class="icon-menu"></i>
                                </div>
                                <!-- Toggle sidebar end -->

                                <!-- Mega Menu Start -->
                                <!-- Mega Menu End -->

                                <!-- Search input group start -->
                                <!-- Search input group end -->

                            </div>
                            <!-- Search container end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

                            <!-- Header actions start -->
                            <ul class="header-actions">
                                <li class="dropdown">
                                    <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                                        শাহ্আলী মাজার
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                                        <i class="icon-alert-triangle"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end lrg" aria-labelledby="notifications">
                                        <div class="dropdown-menu-header">
                                            Notifications (7)
                                        </div>
                                        <div class="customScroll">
                                            <ul class="header-notifications">
                                                <li>
                                                    <a href="#">
                                                        <div class="user-img online">
                                                            <img src="{{asset('custom/img/user6.png')}}" alt="User">
                                                        </div>
                                                        <div class="details">
                                                            <div class="user-title">Larkyn</div>
                                                            <div class="noti-details">Check out every table in detail.</div>
                                                            <div class="noti-date">April 25, 04:00 pm</div>
                                                        </div>
                                                    </a>
                                                </li>      
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="javascript:void(0)" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                                        <span class="avatar">
                                            <img src="{{asset('custom/img/user5.png')}}" alt="User Avatar">
                                            <span class="status busy"></span>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end md" aria-labelledby="userSettings" style="width: 21rem">
                                        <div class="header-profile-actions">
                                            <!-- <a href="#"><i class="icon-user1"></i>Profile</a>
                                            <a href="#"><i class="icon-settings1"></i>Settings</a> -->
                                            <a href="href="{{ route('logout') }}"" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-log-out1"></i>Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- Header actions end -->

                        </div>
                    </div>
                    <!-- Row end -->                    

                </div>
                <!-- Page header ends -->
                @yield('content') 
                <!-- App footer start -->
                <div class="app-footer">© BinaryIT <?php echo date('Y')?></div>
                <!-- App footer end -->
            </div>           
            <!-- ************************* Main container end ************************** -->

        </div>
        <!-- Page wrapper end -->

        <!-- *************
            ************ Required JavaScript Files *************
        ************* -->
        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        {!!Html::script('custom/js/jquery.min.js')!!}
        {!!Html::script('custom/js/bootstrap.bundle.min.js')!!}
        {!!Html::script('custom/js/modernizr.js')!!}
        {!!Html::script('custom/js/moment.js')!!}
        
        {!!Html::script('custom/js/webcam.min.js')!!}

        <!-- *************
            ************ Vendor Js Files *************
        ************* -->
        
        <!-- Megamenu JS -->
        {!!Html::script('custom/vendor/megamenu/js/megamenu.js')!!}
        {!!Html::script('custom/vendor/megamenu/js/custom.js')!!}

        <!-- Slimscroll JS -->
        {!!Html::script('custom/vendor/slimscroll/slimscroll.min.js')!!}
        {!!Html::script('custom/vendor/slimscroll/custom-scrollbar.js')!!}

        <!-- Search Filter JS -->
        {!!Html::script('custom/vendor/search-filter/search-filter.js')!!}
        {!!Html::script('custom/vendor/search-filter/custom-search-filter.js')!!}

        <!-- Data Tables -->
        {!!Html::script('custom/vendor/datatables/dataTables.min.js')!!}
        {!!Html::script('custom/vendor/datatables/dataTables.bootstrap.min.js')!!}
        
        <!-- Custom Data tables -->
        {!!Html::script('custom/vendor/datatables/custom/custom-datatables.js')!!}

        <!-- Download / CSV / Copy / Print -->
        {!!Html::script('custom/vendor/datatables/buttons.min.js')!!}
        {!!Html::script('custom/vendor/datatables/jszip.min.js')!!}
        {!!Html::script('custom/vendor/datatables/pdfmake.min.js')!!}
        {!!Html::script('custom/vendor/datatables/vfs_fonts.js')!!}
        {!!Html::script('custom/vendor/datatables/html5.min.js')!!}
        {!!Html::script('custom/vendor/datatables/buttons.print.min.js')!!}

        <!-- Apex Charts -->
        <!-- {!!Html::script('custom/vendor/apex/apexcharts.min.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/salesGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/ordersGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/earningsGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/visitorsGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/customersGraph.js')!!}
        {!!Html::script('custom/vendor/apex/custom/home/sparkline.js')!!} -->

        <!-- Circleful Charts -->
        <!-- {!!Html::script('custom/vendor/circliful/circliful.min.js')!!}
        {!!Html::script('custom/vendor/circliful/circliful.custom.js')!!} -->

        <!-- Main Js Required -->
        {!!Html::script('custom/js/main.js')!!}

        <!-- Date Range JS -->
        {!!Html::script('custom/vendor/daterange/daterange.js')!!}
        {!!Html::script('custom/vendor/daterange/custom-daterange.js')!!}

        <!-- Sweet alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.confirmdelete').on('click', function (event) {
              event.preventDefault();
                  var $form = $(this).closest('form');
                  swal({
                      title: "Are you sure?",
                      text: $(this).attr('confirm'),
                      type: "warning",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      $form.submit();
                    }
                  });
            });

            $(document).ready( function () {
              $('#dataTable').DataTable({
                "paging":   true,
                "ordering": true,
                "info":     true,
              });
            });

            function printReport() {
                //("#print_icon").hide();
                var reportTablePrint=document.getElementById("printTable");
                newWin= window.open("");
                //newWin.document.write('<table width="100%"><tr><td><center>শুকরিয়া মার্কেট<br>জিন্দা বাজার, সিলেট<br>(+৮৮০) ১৭১১৭২১০৮০</center></td></tr></table><br>');
                newWin.document.write('<table width="100%"><tr><td><center>Hotel Booking System</center></td></tr></table><br>');
                newWin.document.write(reportTablePrint.innerHTML);
                newWin.print();
                newWin.close();
                ("#print_icon").show();
            }

            $('.keyup').on('keyup', function () {
              if ($('#newPass').val() == $('#confirmPass').val()) {
                $('#confirmMsg').html('Password Matched !').css('color', 'green');
              } else 
                $('#confirmMsg').html('Password Do not Matched !').css('color', 'red');
            });
        </script>

        <!--jquery datepicker-->
        <!-- <link href= "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
            $(function() {
              $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

              $(".monthpicker").datepicker({
                  changeMonth: true,
                  changeYear: true,
                  dateFormat: "MM-yy",
                  showButtonPanel: true,
                  currentText: "This Month",
                  onChangeMonthYear: function (year, month, inst) {
                      $(this).val($.datepicker.formatDate('MM-yy', new Date(year, month - 1, 1)));
                  },
                  onClose: function(dateText, inst) {
                      var month = $(".ui-datepicker-month :selected").val();
                      var year = $(".ui-datepicker-year :selected").val();
                      $(this).val($.datepicker.formatDate('MM-yy', new Date(year, month, 1)));
                  }
              }).focus(function () {
                  $(".ui-datepicker-calendar").hide();
              }).after(
                  $("<a href='javascript: void(0);'>clear</a>").click(function() {
                      $(this).prev().val('');
                  })
              );
            });
        </script> -->
        <!--./jquery datepicker-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
        <script type="text/javascript">
            $(document).ready(function(){
              $('select2').select2({ width: '100%', height: '100%', placeholder: "Select an Option", allowClear: true });

            });
        </script>
    </body>
</html>