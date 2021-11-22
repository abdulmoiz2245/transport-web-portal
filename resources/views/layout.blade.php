<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{  $data['page_title']  }} - {{ config('app.name', 'Asyncs') }}</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/datatables.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/css/style.css">
        @yield('css')
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/pickadate/classic.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/pickadate/classic.date.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/datatables.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/sweetalert2.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/bootstrap-datepicker.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard_theme_arrows.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard_theme_circles.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard_theme_dots.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/toastr.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/select2-bootstrap.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/fonts/fontawesome/css/all.min.css">

       
        
        <!-- <script src="<?= asset('assets') ?>/js/vendor/sweetalert2.js"></script> -->
        
        <script src="<?= asset('assets') ?>/js/vendor/sweetalert2.min.js"></script>
          <script src="<?= asset('assets') ?>/js/vendor/jquery-3.3.1.min.js"></script>
          
        <script src="<?= asset('assets') ?>/js/vendor/bootstrap.bundle.min.js"></script>
        
        <link rel="stylesheet" href="<?= asset('assets') ?>/include/jquery_ui/themes/start/jquery-ui.min.css">
        <!-- <script src="<?= asset('assets') ?>/include/jquery/jquery-1.12.4.min.js"></script> -->
        <script src="<?= asset('assets') ?>/include/jquery_ui/jquery-ui.min.js"></script>

        <script src="<?= asset('assets') ?>/js/vendor/jquery.mask.min.js"></script>
        <script src="<?= asset('assets') ?>\js\vendor\jquery.smartWizard.min.js"></script>
        <link rel="stylesheet" href="<?= asset('assets') ?>/js/vendor/tags/bootstrap_tagsinput.css">
        

        <script src="<?= asset('assets') ?>/js/vendor/tags/bootstrap_tagsinput.js"></script>
           <!-- Select2 CSS --> 
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->

<!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    </head>

    <body>
        <div class='ajax-loadscreen' id="ajax-preloader">
            <div class="ajax-loader spinner-bubble spinner-bubble-primary"></div>
        </div>
        <div class="app-admin-wrap">
            <div class="main-header">
                <div class="logo">
                    <!-- <img src="<?= asset('assets') ?>/images/logo.png" alt=""> -->
                </div>

                <div class="menu-toggle">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <div style="margin: auto"></div>

                <div class="header-part-right">
                    
                    <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
                    <div class="dropdown mr-2">
                    <div class="badge-top-container" id="dropdownNotification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-primary">2</span>
                        <i class="i-Bell text-muted header-icon"></i>
                    </div>
                    <!-- Notification dropdown -->
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown ps ps--active-y " aria-labelledby="dropdownNotification" data-perfect-scrollbar="" data-suppress-scroll-x="true" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(40px, 36px, 0px);">
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New message</span>
                                    <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 sec ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Abdul: Hey! are you busy?</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Data-Power text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Server Up!</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">14 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Server rebooted successfully</p>
                            </div>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px; height: 260px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 234px;"></div></div></div>
                    </div>
                    <div class="dropdown">
                        <div class="user colalign-self-end">
                            @if (Auth::user()->profile_pic != '' )
                            <img id="profile_pic" src=" {{  asset('main_admin/profile') }}/{{ Auth::user()->profile_pic }}" alt="{{ Auth::user()->profile_pic }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                            @else 
                            <img id="profile_pic" src="{{  asset('main_admin/profile') }}/no_image.jpg" alt="no-img"  id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                            @endif
                           
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <div class="dropdown-header">
                                    <i class="i-Lock-User mr-1"></i>  {{ Auth::user()->username }}
                                </div>
                                <a class="dropdown-item" href="{{ route('admin.setting.profile') }}">Profile settings</a>
                              
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" class="dropdown-item"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

           <div class="side-content-wrap">
              <div class="sidebar-left open" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item active" data-item="dashboard">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
            
                    <li class="nav-item " data-item="module_1">
                        <a class="nav-item-hold" href="">
                            <i class="nav-icon i-Male-21"></i>
                            <span class="nav-text">HR-PRO</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    
                    <li class="nav-item " data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.customer.customer') }}">
                            <i class="nav-icon i-Administrator"></i>
                            <span class="nav-text">Customer</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    
                    <li class="nav-item " data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.supplier.supplier') }}">
                            <i class="nav-icon i-Cool-Guy"></i>
                            <span class="nav-text">Supplier</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    
                    <li class="nav-item " data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.purchase.purchase') }}">
                            <i class="nav-icon i-Add-Cart"></i>
                            <span class="nav-text">Purchase</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item " data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.inventory.inventory') }}">
                            <i class="nav-icon i-Box-Full  "></i>
                            <span class="nav-text">Inventory</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
        
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Business-Man"></i>
                            <span class="nav-text">Employee</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Data-Financial"></i>
                            <span class="nav-text">Accounts</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Cash-register-2"></i>
                            <span class="nav-text">Petty-cash</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon  i-Truck"></i>
                            <span class="nav-text">Vehicles</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Factory"></i>
                            <span class="nav-text">Workshop</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.sub_contractor.sub_contractor') }}">
                            <i class="nav-icon i-Diploma-2"></i>
                            <span class="nav-text">Sub-Contractors</span>
                        </a>
                        <div class="triangle"></div>
                    </li> 
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Calendar-4"></i>
                            <span class="nav-text">Booking</span>
                        </a>
                        <div class="triangle"></div>
                    </li> 
                    <li class="nav-item" data-item="">
                        <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-File-Clipboard-File--Text"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="setting">
                        <a class="nav-item-hold" href="">
                            <i class="nav-icon i-Gear"></i>
                            <span class="nav-text">Setting</span>
                        </a>
                        <div class="triangle"></div>
                    </li>  

                </ul>
            </div>

            <div class="sidebar-left-secondary" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <!-- Submenu Dashboards -->
                <ul class="childNav" data-parent="setting">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.profile') }}">
                            <i class="nav-icon i-ID-3"></i>
                            <span class="item-name">Profile</span>
                        </a>
                    </li>
                    
                </ul>
                

                <ul class="childNav" data-parent="dashboard">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>
                </ul>

                <ul class="childNav" data-parent="dashboard">
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}">
                            <i class="nav-icon i-Mail-Add-"></i>
                            <span class="item-name">Generate Emails</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="dashboard">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.role') }}">
                            <i class="nav-icon i-Clock-3"></i>
                            <span class="item-name">Roles and Permissions</span>
                        </a>
                    </li>
                </ul>

                @foreach ($data['modules'] as $module)
                    @if($module->parent_id != 0) 
                   

                        <ul class="childNav" data-parent="module_{{$module->parent_id}}">
                            <li class="nav-item">
                                <a href="{{ route('admin.'.$module->nickname ) }}">
                                    <i class="nav-icon {{$module->icon}}"></i>
                                    <span class="item-name">{{$module->name}}</span>
                                </a>
                            </li>
                        </ul>
                        
                    
                    @endif
                @endforeach
                
            </div>
           
            <div class="sidebar-overlay"></div>
        </div>
        <!--=============== Left side End ================-->

           
        </div>
            
            <div class="main-content-wrap sidenav-open d-flex flex-column">

                <div class="breadcrumb">
                    <h1><?= $data['page_title'] ?></h1>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <?=  view($data['view'])->with('data', $data); ?>
                    </div>
                </div>
                <div class="flex-grow-1"></div>
                <div class="app-footer">
                    <div class="row">
                    <div class="col-md-9">
                        <p><strong>Admin portal - Asyncs </strong></p>
                        
                    </div>
                </div>
                    <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">

                        <span class="flex-grow-1"></span>
                        <div class="d-flex align-items-center">
                            <!-- <img class="logo" src="<?= asset('assets') ?>/images/logo.png" alt=""> -->
                            <div>
                                <p class="m-0">&copy; <?= date('Y') ?> Asyncs</p>
                                <p class="m-0">All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="search-ui">
            <div class="search-header">
                <img src="<?= asset('assets') ?>/images/logo.png" alt="" class="logo">
                <button class="search-close btn btn-icon bg-transparent float-right mt-2">
                    <i class="i-Close-Window text-22 text-muted"></i>
                </button>
            </div>
        </div>
        
        <script>
            var url = "<?= asset('assets') ?>/images";
            var base_url = "<?= url('/') ?>";
        </script>
        <script src="<?= asset('assets') ?>/js/vendor/jquery.mask.min.js"></script>
     

        <script src="<?= asset('assets') ?>/js/jquery.fileDownload.js"></script>

        <script src="<?= asset('assets') ?>/js/vendor/perfect-scrollbar.min.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/datatables.min.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/pickadate/picker.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/pickadate/picker.date.js"></script>
        <script src="<?= asset('assets') ?>/js/es5/script.min.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/datatables.min.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/toastr.min.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/dropzone.min.js"></script>
        <script src="<?= asset('assets') ?>/js/vendor/bootstrap-datepicker.min.js"></script>
        <script src="<?= asset('assets') ?>/js/scripts.js"></script>
        <script src="<?= asset('assets') ?>\js\sidebar.script.js"></script>
        <script>
            $(document).ready(function() {
                $("#Material_Data").select2({
                    tags: true
                });
            });

            $(document).ready(function() {
                $(".Tyre_Serial_Nummber").select2({
                    tags: true
                });
            });
        </script>
    </body>

</html>