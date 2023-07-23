<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Shah Ali Mazar">
        <meta name="author" content="ParkerThemes">
        <link rel="shortcut icon" href="{{asset('custom/img/fav.png')}}">

        <!-- Title -->
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;500&display=swap" rel="stylesheet">


        <!-- *************
            ************ Common Css Files *************
        ************ -->
        <!-- Bootstrap css -->
        {!!Html::style('custom/css/bootstrap.min.css')!!}
        
        <!-- Icomoon Font Icons css -->
        {!!Html::style('custom/fonts/style.css')!!}
        <!-- Main css for green -->
        {!!Html::style('custom/css/green-main.css')!!}


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

        <!-- Bootstrap Select CSS -->
        {!!Html::style('custom/vendor/bs-select/bs-select.css')!!}
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

            .slimScrollBar {
                width: 15px !important;
            }

            .default-sidebar-wrapper .default-sidebar-menu ul li.active a span {
                /*background: #e02539;
                color: #ffffff;
                border-radius: 4px;
                padding: 9px;*/
                font-weight: bold;
            }

            .default-sidebar-wrapper .default-sidebar-menu ul li.active a.current-page {
                background: #17995e;
                pointer-events: auto;
                position: relative;
                color: #ffffff;
            }
            .default-sidebar-wrapper .default-sidebar-menu ul li.active a.current-page:hover {
                background: #17995e;
                /*pointer-events: none;*/
                position: relative;
                color: #ffffff;
            }
            table.dataTable tr.odd {
            	background: #f6f6fd;
            }
            table.dataTable tr.even {
            	background: #ffffff;
            }
            table.dataTable td {
                border: 0;
                padding: 0.5rem 0.75rem;
                white-space: normal;
            }
            div.dataTables_wrapper div.dataTables_info {
            	padding: 0.425em 1.5em;
            	display: inline-block;
            	font-size: .725rem;
            	background: #f6f6fd !important;
            	margin-top: 10px;
            	border-radius: 2px;
            }
            
            /* Pagination */
            .pagination .page-link {
                color: #7980a2;
                border: 1px solid #dee2e6;
                background: #fff;
            }
            .pagination .page-link:hover {
                background: #dee2e6;
            }
            .page-item.active .page-link {
                z-index: 3;
                color: #fff;
                background-color: #4285f4;
                border-color: #4285f4;
            }
            .page-item.disabled .page-link {
                color: #7980a2;
                pointer-events: none;
                background-color: #fff;
                border-color: #dee2e6;
            }
        </style>
        
    </head>
    <?php
        $baseUrl = URL::to('/');
        $url = Request::path();
    ?>
    <body class="default-sidebar">

        <!-- Loading wrapper start -->
        <div id="loading-wrapper">
            {{-- <div class="spinner-border"></div> --}}
        </div>
        <!-- Loading wrapper end -->

        <!-- Page wrapper start -->
        <div class="page-wrapper">
            
            <!-- Sidebar wrapper start -->
            <nav class="sidebar-wrapper">
                
                <!-- Default sidebar wrapper start -->
                <div class="default-sidebar-wrapper">

                    <!-- Sidebar brand starts -->
                    <div class="default-sidebar-brand">
                        <a href="{{URL::to('/home')}}" class="logo">
                            <!-- <img src="{{asset('custom/img/logo.svg')}}" alt="Admin" /> -->
                            <!-- <h5>E-Store</h5><br> -->
                            <h6>{{Auth::user()->name}}</h6>
                        </a>
                    </div>
                    <!-- Sidebar brand starts -->

                    <!-- Sidebar menu starts -->
                    <div class="defaultSidebarMenuScroll">
                        <div class="default-sidebar-menu">
                            <ul>
                                <!-------------- dashboard part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url=='home' || 
                                    $url==config('app.account').'/daily-transaction' ||
                                    $url==config('app.or').'/receive-voucher-report' ||
                                    $url==config('app.op').'/payment-voucher-report' ||
                                    $url==config('app.utility').'/crm') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-home2"></i>
                                        <span class="menu-text">{{ __('menu.dashboard') }}</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/home'}}"  class="{{($url=='home') ? 'current-page':''}}">{{ __('menu.home') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.account').'/daily-transaction'}}"  class="{{($url==config('app.account').'/daily-transaction') ? 'current-page':''}}">{{ __('menu.Daily_Transaction') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-voucher-report'}}" class="{{($url==config('app.or').'/receive-voucher-report') ? 'current-page':''}}">Receive Report </a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-voucher-report'}}" class="{{($url==config('app.op').'/payment-voucher-report') ? 'current-page':''}}">Payment Report</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/crm'}}" class="{{($url==config('app.utility').'/crm') ? 'current-page':''}}">CRM</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- account part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.account').'/account-type' || $url==(request()->is(config('app.account').'/account-type/*/edit')) ||
                                    $url==config('app.account').'/bank-account' || 
                                    $url==config('app.account').'/cheque-book' || 
                                    $url==config('app.account').'/cheque-no' || 
                                    $url==(request()->is(config('app.account').'/bank-deposit/*')) || 
                                    $url==(request()->is(config('app.account').'/amount-withdraw/*')) || 
                                    $url==(request()->is(config('app.account').'/amount-transfer/*')) || 
                                    $url==(request()->is(config('app.account').'/bank-report/*')) ||
                                    $url==config('app.or').'/receive-type' ||
                                    $url==config('app.or').'/receive-sub-type' ||
                                    $url==config('app.or').'/receive-voucher' ||
                                    $url==config('app.op').'/payment-type' ||
                                    $url==config('app.op').'/payment-sub-type' ||
                                    $url==config('app.op').'/payment-voucher') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-dollar-sign"></i>
                                        <span class="menu-text">{{ __('menu.account_management') }}</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.account').'/account-type'}}" class="{{($url==config('app.account').'/account-type' || $url==(request()->is(config('app.account').'/account-type/*/edit'))) ? 'current-page':''}}">{{ __('menu.account_type') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.account').'/bank-account'}}" class="{{($url==config('app.account').'/bank-account' || $url==(request()->is(config('app.account').'/bank-deposit/*')) || $url==(request()->is(config('app.account').'/amount-withdraw/*')) || $url==(request()->is(config('app.account').'/amount-transfer/*')) || $url==(request()->is(config('app.account').'/bank-report/*'))) ? 'current-page':''}}">{{ __('menu.bank_account') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.account').'/cheque-book'}}" class="{{($url==config('app.account').'/cheque-book') ? 'current-page':''}}">{{ __('menu.cheque_book') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.account').'/cheque-no'}}" class="{{($url==config('app.account').'/cheque-no') ? 'current-page':''}}">{{ __('menu.cheque_no') }}</a>
                                            </li>
                                            <li class="list-heading" style="margin-left: 30px"><b>{{ __('menu.income') }}</b></li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-type'}}" class="{{($url==config('app.or').'/receive-type') ? 'current-page':''}}">Receive Type</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-sub-type'}}" class="{{($url==config('app.or').'/receive-sub-type') ? 'current-page':''}}">Receive Sub Type</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.or').'/receive-voucher'}}" class="{{($url==config('app.or').'/receive-voucher') ? 'current-page':''}}">Receive Voucher</a>
                                            </li>
                                            <li class="list-heading" style="margin-left: 30px"><b>{{ __('menu.expense') }}</b></li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-type'}}" class="{{($url==config('app.op').'/payment-type') ? 'current-page':''}}">Payment Type</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-sub-type'}}" class="{{($url==config('app.op').'/payment-sub-type') ? 'current-page':''}}">Payment Sub Type</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.op').'/payment-voucher'}}" class="{{($url==config('app.op').'/payment-voucher') ? 'current-page':''}}">Payment Voucher</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- insurance utitility part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.utility').'/client' || $url==config('app.utility').'/client/create' || $url==(request()->is(config('app.utility').'/client/*/edit')) ||
                                    $url==config('app.utility').'/bank' || $url==config('app.utility').'/bank/create' || $url==(request()->is(config('app.utility').'/bank/*/edit')) ||
                                    $url==config('app.utility').'/voyage-from' || $url==config('app.utility').'/voyage-from/create' || $url==(request()->is(config('app.utility').'/voyage-from/*/edit')) ||
                                    $url==config('app.utility').'/voyage-to' || $url==config('app.utility').'/voyage-to/create' || $url==(request()->is(config('app.utility').'/voyage-to/*/edit')) ||
                                    $url==config('app.utility').'/voyage-via' || $url==config('app.utility').'/voyage-via/create' || $url==(request()->is(config('app.utility').'/voyage-via/*/edit')) ||
                                    $url==config('app.utility').'/transit-by' || $url==config('app.utility').'/transit-by/create' || $url==(request()->is(config('app.utility').'/transit-by/*/edit')) ||
                                    $url==config('app.utility').'/currency' || $url==config('app.utility').'/currency/create' || $url==(request()->is(config('app.utility').'/currency/*/edit')) ||
                                    $url==config('app.utility').'/additional-perils' || $url==config('app.utility').'/additional-perils/create' || $url==(request()->is(config('app.utility').'/additional-perils/*/edit')) ||
                                    $url==config('app.utility').'/motor-certificate-type' || $url==config('app.utility').'/motor-certificate-type/create' || $url==(request()->is(config('app.utility').'/motor-certificate-type/*/edit')) ||
                                    $url==config('app.utility').'/type-of-certificate' || $url==config('app.utility').'/type-of-certificate/create' || $url==(request()->is(config('app.utility').'/type-of-certificate/*/edit')) ||
                                    $url==config('app.utility').'/tarrif-type' || $url==config('app.utility').'/tarrif-type/create' || $url==(request()->is(config('app.utility').'/tarrif-type/*/edit')) ||
                                    $url==config('app.utility').'/tarrif-calculation' || $url==config('app.utility').'/tarrif-calculation/create' || $url==(request()->is(config('app.utility').'/tarrif-calculation/*/edit')) ||
                                    $url==config('app.utility').'/insuranceRates' || $url==config('app.utility').'/insuranceRates/create' || $url==(request()->is(config('app.utility').'/insuranceRates/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Insurance Utility</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/client'}}" class="{{($url==config('app.utility').'/client' || $url==config('app.utility').'/client/create' || $url==(request()->is(config('app.utility').'/client/*/edit'))) ? 'current-page':''}}">Client/Insured</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/bank'}}" class="{{($url==config('app.utility').'/bank' || $url==config('app.utility').'/bank/create' || $url==(request()->is(config('app.utility').'/bank/*/edit'))) ? 'current-page':''}}">Bank</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/voyage-from'}}" class="{{($url==config('app.utility').'/voyage-from' || $url==config('app.utility').'/voyage-from/create' || $url==(request()->is(config('app.utility').'/voyage-from/*/edit'))) ? 'current-page':''}}">Voyage From</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/voyage-to'}}" class="{{($url==config('app.utility').'/voyage-to' || $url==config('app.utility').'/voyage-to/create' || $url==(request()->is(config('app.utility').'/voyage-to/*/edit'))) ? 'current-page':''}}">Voyage To</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/voyage-via'}}" class="{{($url==config('app.utility').'/voyage-via' || $url==config('app.utility').'/voyage-via/create' || $url==(request()->is(config('app.utility').'/voyage-via/*/edit'))) ? 'current-page':''}}">Voyage Via</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/transit-by'}}" class="{{($url==config('app.utility').'/transit-by' || $url==config('app.utility').'/transit-by/create' || $url==(request()->is(config('app.utility').'/transit-by/*/edit'))) ? 'current-page':''}}">Transit By</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/currency'}}" class="{{($url==config('app.utility').'/currency' || $url==config('app.utility').'/currency/create' || $url==(request()->is(config('app.utility').'/currency/*/edit'))) ? 'current-page':''}}">Currency</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/additional-perils'}}" class="{{($url==config('app.utility').'/additional-perils' || $url==config('app.utility').'/additional-perils/create' || $url==(request()->is(config('app.utility').'/additional-perils/*/edit'))) ? 'current-page':''}}">Additional Perlis</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/motor-certificate-type'}}" class="{{($url==config('app.utility').'/motor-certificate-type' || $url==config('app.utility').'/motor-certificate-type/create' || $url==(request()->is(config('app.utility').'/motor-certificate-type/*/edit'))) ? 'current-page':''}}">Motor Certificate Type</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/type-of-certificate'}}" class="{{($url==config('app.utility').'/type-of-certificate' || $url==config('app.utility').'/type-of-certificate/create' || $url==(request()->is(config('app.utility').'/type-of-certificate/*/edit'))) ? 'current-page':''}}">Type of Certificate</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/tarrif-type'}}" class="{{($url==config('app.utility').'/tarrif-type' || $url==config('app.utility').'/tarrif-type/create' || $url==(request()->is(config('app.utility').'/tarrif-type/*/edit'))) ? 'current-page':''}}">Tarrif Type</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/tarrif-calculation'}}" class="{{($url==config('app.utility').'/tarrif-calculation' || $url==config('app.utility').'/tarrif-calculation/create' || $url==(request()->is(config('app.utility').'/tarrif-calculation/*/edit'))) ? 'current-page':''}}">Tarrif Calculation</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.utility').'/insuranceRates'}}" class="{{($url==config('app.utility').'/insuranceRates' || $url==config('app.utility').'/insuranceRates/create' || $url==(request()->is(config('app.utility').'/insuranceRates/*/edit'))) ? 'current-page':''}}">Insurance Rate</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- product part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.product').'/product-category' || $url==config('app.product').'/product-category/create' || $url==(request()->is(config('app.product').'/product-category/*/edit')) ||
                                    $url==config('app.product').'/product-sub-category' || $url==config('app.product').'/product-sub-category/create' || $url==(request()->is(config('app.product').'/product-sub-category/*/edit')) ||
                                    $url==config('app.product').'/product' || $url==config('app.product').'/product/create' || $url==(request()->is(config('app.product').'/product/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">{{ __('menu.Product_Management') }}</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.product').'/product-category'}}" class="{{($url==config('app.product').'/product-category' || $url==config('app.product').'/product-category/create' || $url==(request()->is(config('app.product').'/product-category/*/edit'))) ? 'current-page':''}}">Product Category</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.product').'/product-sub-category'}}" class="{{($url==config('app.product').'/product-sub-category' || $url==config('app.product').'/product-sub-category/create' || $url==(request()->is(config('app.product').'/product-sub-category/*/edit'))) ? 'current-page':''}}">Product Sub Category</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.product').'/product'}}" class="{{($url==config('app.product').'/product' ||  $url==config('app.product').'/product/create' || $url==(request()->is(config('app.product').'/product/*/edit'))) ? 'current-page':''}}">{{ __('menu.Product') }} List</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- marine cargo insurance part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.marine').'/marine-cargo-insurance' || $url==config('app.marine').'/marine-cargo-insurance/create' || $url==(request()->is(config('app.marine').'/marine-cargo-insurance/*/edit')) ||
                                    $url==config('app.marine').'/marine-bill-collection' ||
                                    $url==config('app.marine').'/marine-bill-collection-report') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Marine Cargo Insurance</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.marine').'/marine-cargo-insurance'}}" class="{{($url==config('app.marine').'/marine-cargo-insurance' || $url==config('app.marine').'/marine-cargo-insurance/create' || $url==(request()->is(config('app.marine').'/marine-cargo-insurance/*/edit'))) ? 'current-page':''}}">Create Insurance</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.marine').'/marine-bill-collection'}}" class="{{($url==config('app.marine').'/marine-bill-collection') ? 'current-page':''}}">Bill Collection</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.marine').'/marine-bill-collection-report'}}" class="{{($url==config('app.marine').'/marine-bill-collection-report') ? 'current-page':''}}">Bill Collection Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- fire insurance part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.fire').'/fire-insurance' || $url==config('app.fire').'/fire-insurance/create' || $url==(request()->is(config('app.fire').'/fire-insurance/*/edit')) ||
                                    $url==config('app.fire').'/fire-bill-collection' ||
                                    $url==config('app.fire').'/fire-bill-collection-report') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Fire Insurance</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.fire').'/fire-insurance'}}" class="{{($url==config('app.fire').'/fire-insurance' || $url==config('app.fire').'/fire-insurance/create' || $url==(request()->is(config('app.fire').'/fire-insurance/*/edit'))) ? 'current-page':''}}">Create Insurance</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.fire').'/fire-bill-collection'}}" class="{{($url==config('app.fire').'/fire-bill-collection') ? 'current-page':''}}">Bill Collection</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.fire').'/fire-bill-collection-report'}}" class="{{($url==config('app.fire').'/fire-bill-collection-report') ? 'current-page':''}}">Bill Collection Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- motor insurance part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.motor').'/motor-insurance' || $url==config('app.motor').'/motor-insurance/create' || $url==(request()->is(config('app.motor').'/motor-insurance/*/edit')) ||
                                    $url==config('app.motor').'/motor-bill-collection' ||
                                    $url==config('app.motor').'/motor-bill-collection-report') ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Motor Insurance</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.motor').'/motor-insurance'}}" class="{{($url==config('app.motor').'/motor-insurance' || $url==config('app.motor').'/motor-insurance/create' || $url==(request()->is(config('app.motor').'/motor-insurance/*/edit'))) ? 'current-page':''}}">Create Insurance</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.motor').'/motor-bill-collection'}}" class="{{($url==config('app.motor').'/motor-bill-collection') ? 'current-page':''}}">Bill Collection</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.motor').'/motor-bill-collection-report'}}" class="{{($url==config('app.motor').'/motor-bill-collection-report') ? 'current-page':''}}">Bill Collection Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- commission part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.commission').'/payment-title' || $url==config('app.commission').'/payment-title/create' || $url==(request()->is(config('app.commission').'/payment-title/*/edit')) ||
                                    $url==config('app.commission').'/marine-commission' || $url==config('app.commission').'/marine-commission/create' || $url==(request()->is(config('app.commission').'/marine-commission/*/edit')) ||
                                    $url==config('app.commission').'/fire-commission' || $url==config('app.commission').'/fire-commission/create' || $url==(request()->is(config('app.commission').'/fire-commission/*/edit')) ||
                                    $url==config('app.commission').'/motor-commission' || $url==config('app.commission').'/motor-commission/create' || $url==(request()->is(config('app.commission').'/motor-commission/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-box"></i>
                                        <span class="menu-text">Commission</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.commission').'/payment-title'}}" class="{{($url==config('app.commission').'/payment-title' || $url==config('app.commission').'/payment-title/create' || $url==(request()->is(config('app.commission').'/payment-title/*/edit'))) ? 'current-page':''}}">Payment Title</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.commission').'/marine-commission'}}" class="{{($url==config('app.commission').'/marine-commission' || $url==config('app.commission').'/marine-commission/create' || $url==(request()->is(config('app.commission').'/marine-commission/*/edit'))) ? 'current-page':''}}">Marine Commission</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.commission').'/fire-commission'}}" class="{{($url==config('app.commission').'/fire-commission' || $url==config('app.commission').'/fire-commission/create' || $url==(request()->is(config('app.commission').'/fire-commission/*/edit'))) ? 'current-page':''}}">Fire Commission</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.commission').'/motor-commission'}}" class="{{($url==config('app.commission').'/motor-commission' || $url==config('app.commission').'/motor-commission/create' || $url==(request()->is(config('app.commission').'/motor-commission/*/edit'))) ? 'current-page':''}}">Motor Commission</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.commission').'/commission-report'}}" class="{{($url==config('app.commission').'/commission-report' || $url==config('app.commission').'/commission-report/create' || $url==(request()->is(config('app.commission').'/commission-report/*/edit'))) ? 'current-page':''}}">Commission Report</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- user part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.user').'/department' || $url==config('app.user').'/department/create' || $url==(request()->is(config('app.user').'/department/*/edit')) ||
                                    $url==config('app.user').'/designation' || $url==config('app.user').'/designation/create' || $url==(request()->is(config('app.user').'/designation/*/edit')) ||
                                    $url==config('app.user').'/branch' || $url==config('app.user').'/branch/create' || $url==(request()->is(config('app.user').'/branch/*/edit')) ||
                                    $url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit')) ||
                                    $url==config('app.user').'/user-role' || $url==config('app.user').'/user-role/create' || $url==(request()->is(config('app.user').'/user-role/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-user"></i>
                                        <span class="menu-text">Employee Management</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/department'}}" class="{{($url==config('app.user').'/department' || $url==config('app.user').'/department/create' || $url==(request()->is(config('app.user').'/department/*/edit'))) ? 'current-page':''}}">Department</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/designation'}}" class="{{($url==config('app.user').'/designation' || $url==config('app.user').'/designation/create' || $url==(request()->is(config('app.user').'/designation/*/edit'))) ? 'current-page':''}}">Designation</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/branch'}}" class="{{($url==config('app.user').'/branch' || $url==config('app.user').'/branch/create' || $url==(request()->is(config('app.user').'/branch/*/edit'))) ? 'current-page':''}}">Branch</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/user-list'}}" class="{{($url==config('app.user').'/user-list' || $url==config('app.user').'/user-list/create' || $url==(request()->is(config('app.user').'/user-list/*/edit'))) ? 'current-page':''}}">Employee</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.user').'/user-role'}}" class="{{($url==config('app.user').'/user-role' || $url==config('app.user').'/user-role/create' || $url==(request()->is(config('app.user').'/user-role/*/edit'))) ? 'current-page':''}}">User Role</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-------------- amendment part ------------>
                                <li class="default-sidebar-dropdown {{(
                                    $url==config('app.amendment').'/other-receive-amenment' || $url==config('app.amendment').'/other-receive-amenment/create' || $url==(request()->is(config('app.amendment').'/other-receive-amenment/*/edit')) ||
                                    $url==config('app.amendment').'/other-payment-amenment' || $url==config('app.amendment').'/other-payment-amenment/create' || $url==(request()->is(config('app.amendment').'/other-payment-amenment/*/edit')) ||
                                    $url==config('app.amendment').'/bank-deposit-amendment' || $url==config('app.amendment').'/bank-deposit-amendment/create' || $url==(request()->is(config('app.amendment').'/bank-deposit-amendment/*/edit')) ||
                                    $url==config('app.amendment').'/bank-withdraw-amendment' || $url==config('app.amendment').'/bank-withdraw-amendment/create' || $url==(request()->is(config('app.amendment').'/bank-withdraw-amendment/*/edit')) ||
                                    $url==config('app.amendment').'/bank-transfer-amendment' || $url==config('app.amendment').'/bank-transfer-amendment/create' || $url==(request()->is(config('app.amendment').'/bank-transfer-amendment/*/edit')) ||
                                    $url==config('app.amendment').'/customer-bill-amendment' || $url==config('app.amendment').'/customer-bill-amendment/create' || $url==(request()->is(config('app.amendment').'/customer-bill-amendment/*/edit')) ||
                                    $url==config('app.amendment').'/purchase-product-amendment' || $url==config('app.amendment').'/purchase-product-amendment/create' || $url==(request()->is(config('app.amendment').'/purchase-product-amendment/*/edit'))) ? 'active':''}}">
                                    <a href="javascript::void(0)">
                                        <i class="icon-user"></i>
                                        <span class="menu-text">Amendment</span>
                                    </a>
                                    <div class="default-sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.amendment').'/other-receive-amenment'}}" class="{{($url==config('app.amendment').'/other-receive-amenment' || $url==config('app.amendment').'/other-receive-amenment/create' || $url==(request()->is(config('app.amendment').'/other-receive-amenment/*/edit'))) ? 'current-page':''}}">Receive Voucher</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.amendment').'/other-payment-amenment'}}" class="{{($url==config('app.amendment').'/other-payment-amenment' || $url==config('app.amendment').'/other-payment-amenment/create' || $url==(request()->is(config('app.amendment').'/other-payment-amenment/*/edit'))) ? 'current-page':''}}">Payment Voucher</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.amendment').'/bank-deposit-amendment'}}" class="{{($url==config('app.amendment').'/bank-deposit-amendment' || $url==config('app.amendment').'/bank-deposit-amendment/create' || $url==(request()->is(config('app.amendment').'/bank-deposit-amendment/*/edit'))) ? 'current-page':''}}">Bank Deposit</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.amendment').'/bank-withdraw-amendment'}}" class="{{($url==config('app.amendment').'/bank-withdraw-amendment' || $url==config('app.amendment').'/bank-withdraw-amendment/create' || $url==(request()->is(config('app.amendment').'/bank-withdraw-amendment/*/edit'))) ? 'current-page':''}}">Bank Withdraw</a>
                                            </li>
                                            <li>
                                                <a href="{{$baseUrl.'/'.config('app.amendment').'/bank-transfer-amendment'}}" class="{{($url==config('app.amendment').'/bank-transfer-amendment' || $url==config('app.amendment').'/bank-transfer-amendment/create' || $url==(request()->is(config('app.amendment').'/bank-transfer-amendment/*/edit'))) ? 'current-page':''}}">Bank Transfer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar menu ends -->

                </div>
                <!-- Default sidebar wrapper end -->
                
            </nav>
            <!-- Sidebar wrapper end -->

            <!-- *************
                ************ Main container start *************
            ************* -->
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
                            </div>
                            <!-- Search container end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

                            <!-- Header actions start -->
                            <ul class="header-actions">
                                <li class="dropdown">
                                    <a href="javascript:void(0)" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                                        <span class="avatar">
                                            <img src="{{asset('custom/img/user5.png')}}" alt="User Avatar">
                                            <span class="status busy"></span>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end sm" aria-labelledby="userSettings" style="width: 21rem">
                                        <div class="header-profile-actions">
                                            <!-- <a href="#"><i class="icon-user1"></i>Profile</a>-->
                                            <a href="{{URL::to('settings')}}"><i class="icon-lock"></i>Change Password</a> 
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-log-out1"></i>Logout</a>

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

        <!-- Bootstrap Select JS -->
        {!!Html::script('custom/vendor/bs-select/bs-select.min.js')!!}
        {!!Html::script('custom/vendor/bs-select/bs-select-custom.js')!!}

        <!-- select2 -->
        {!!Html::script('custom/select2/js/select2.min.js')!!}
            
        <script type="text/javascript">
            $(document).ready(function(){
              $('.select2').select2({ width: '100%', height: '100%', placeholder: "Select", allowClear: true });
            });
        </script>

        <!-- Sweet alert -->
        {!!Html::script('custom/sweetalert/sweetalert.min.js')!!}
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

            function printReport() {
                //("#print_icon").hide();
                var reportTablePrint=document.getElementById("printTable");
                newWin= window.open();
                var is_chrome = Boolean(newWin.chrome);
                var top = '<center><img src="{{asset("upload/logo/header.png")}}" height="60px"></center>';
                //   top += '<center><h3>Baby Land Park</h3></center>';
                //   top += '<center><p style="margin-top:-10px">Address</p></center>';
                newWin.document.write(top);
                newWin.document.write(reportTablePrint.innerHTML);
                if (is_chrome) {
                    setTimeout(function () { // wait until all resources loaded 
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus(); // necessary for IE >= 10
                    newWin.print();  // change window to winPrint
                    newWin.close();// change window to winPrint
                    }, 250);
                }
                else {
                    newWin.document.close(); // necessary for IE >= 10
                    newWin.focus(); // necessary for IE >= 10

                    newWin.print();
                    newWin.close();
                }
            }


            $('.keyup').on('keyup', function () {
              if ($('#newPass').val() == $('#confirmPass').val()) {
                $('#confirmMsg').html('Password Matched !').css('color', 'green');
              } else 
                $('#confirmMsg').html('Password Do not Matched !').css('color', 'red');
            });
            

        </script>
    </body>
</html>