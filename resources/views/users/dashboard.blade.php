<div class="container">
    <div class="row">
        <div class="col-12">
            @foreach($data['permission'] as $permissions)
            @if($permissions->module_id == 1)
            @if($permissions->operation == 'view' && $permissions->status == 1)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3">Hr Pro</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    <div class="row">
                    @foreach($data['permission'] as $permissions)
                    
                        @if($permissions->module_id == 30)
                        @if($permissions->operation == 'view' && $permissions->status == 1)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.hr_pro.trade_license__sponsors__partners') }} ">
                                <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Data-Download text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Total Trade License</h4>
                                        <span>Total: {{ $data['trade_license'] }}</span>
                                    </div>
                                </div>
                            </a>   
                        </div>
                        @endif
                        @endif

                        @if($permissions->module_id == 31)
                        @if($permissions->operation == 'view' && $permissions->status == 1)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.hr_pro.office_contracts') }}">
                                <div class="p-4 rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Checked-User text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">OFFICE CONTRACTS</h4>
                                        <span>Total: {{ $data['office_contract']->count() }}</span>
                                    </div>
                                </div>
                            </a>
                            
                        </div>
                        
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.hr_pro.land_contracts') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Remove-User text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1 ">Land Contracts</h4>
                                    <span>Total: {{ $data['land_contract']->count() }}</span>
                                </div>
                                </div>
                            </a>
                            
                        </div>

                        @endif
                        @endif

                        @if($permissions->module_id == 32)
                        @if($permissions->operation == 'view' && $permissions->status == 1)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.hr_pro.non_mobiles_fuel_tanks_renewals') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Cube-Molecule-2 text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1">Non Mobile Fuel Tank</h4>
                                    <div class=""><span> Total Civil Defence :  {{ $data['non_mobile_civil']->count() }}</span></div>
                                    <div class=""><span> Total Muncipality : {{ $data['non_mobile_defence']->count() }}</span></div>
                                    <div class=""><span> Total Trained Individual  :{{ $data['non_mobile_individules']->count() }} </span></div>
                                </div>
                                </div>
                            </a>
                            
                        </div>

                        @endif
                        @endif

                        @if($permissions->module_id == 33)
                        @if($permissions->operation == 'view' && $permissions->status == 1)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.hr_pro.mobiles_fuel_tanks_renewals') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Cube-Molecule-2 text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1"> Mobile Fuel Tank</h4>
                                    <div class=""><span> Total Civil Defence :{{ $data['mobile_civil']->count() }} </span></div>
                                    <div class=""><span> Total Muncipality : {{ $data['mobile_defence']->count() }}</span></div>
                                    <div class=""><span> Total Trained Individual  : {{ $data['mobile_individules']->count() }}</span></div>


                                </div>
                                </div>
                            </a>
                            
                        </div>

                        @endif
                        @endif

                        @if($permissions->module_id == 34)
                        @if($permissions->operation == 'view' && $permissions->status == 1)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.hr_pro.login_access_and_passwords') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Cube-Molecule-2 text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1">Logins and Password</h4>
                                    <!-- <span>Total: </span> -->
                                </div>
                                </div>
                            </a>
                            
                        </div>
                        
                        @endif
                        @endif
                        
                    
                    @endforeach
                    </div>
                </div>
            </div>
            @endif
            @endif
            @endforeach

            @foreach($data['permission'] as $permissions)
            @if($permissions->module_id == 2)
            @if($permissions->operation == 'view' && $permissions->status == 1)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3">Customer</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.customer') }} ">
                                <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Administrator text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Total Customer</h4>
                                        <span>Total: {{ $data['customer'] }}</span>
                                    </div>
                                </div>
                            </a>        
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
            @endforeach


            @foreach($data['permission'] as $permissions)
            @if($permissions->module_id == 3)
            @if($permissions->operation == 'view' && $permissions->status == 1)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3">Supplier</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.supplier') }} ">
                                <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Administrator text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Total Supplier</h4>
                                        <span>Total: {{ $data['supplier'] }}</span>
                                    </div>
                                </div>
                            </a>        
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
            @endforeach

            @foreach($data['permission'] as $permissions)
            @if($permissions->module_id == 11)
            @if($permissions->operation == 'view' && $permissions->status == 1)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3">Sub Contractor</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.sub_contractor') }} ">
                                <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Administrator text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Total Sub Contractor</h4>
                                        <span>Total: {{ $data['sub_contractor'] }}</span>
                                    </div>
                                </div>
                            </a>        
                        </div>
                        
                </div>
            </div>
            @endif
            @endif
            @endforeach

            @foreach($data['permission'] as $permissions)
            @if($permissions->module_id == 4)
            @if($permissions->operation == 'view' && $permissions->status == 1)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3">Total Purchase</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('user.purchase') }} ">
                                <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Administrator text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Total Purchase</h4>
                                        <span>Total: {{ $data['purchase'] }}</span>
                                    </div>
                                </div>
                            </a>        
                        </div>
                        
                </div>
            </div>
            @endif
            @endif
            @endforeach
        </div>
        <div class="col-4">
            <!-- <div class="card mb-4"> -->
                <!-- <div class="card-body"> -->
                    <!-- <div class="card-title m-0">User Activity</div> -->
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    <!-- <div class="row">
                        <div class="col-lg-12 col-md-12 mb-4">
                            <a href="{{ route ('admin.users') }}">
                                <div class="p-4 rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Checked-User text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Online Users</h4>

                                        <span>Total: </span>
                                    </div>
                                </div>
                            </a>
                            
                        </div> 
                    </div> -->
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>
</div> 
