<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0">User Status</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-4">
                            <a href="{{ route ('admin.users') }} ">
                                <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Data-Download text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Total Emails</h4>
                                        <span>Total: {{   $data['total_user'] }}</span>
                                    </div>
                                </div>
                            </a>
                                
                        </div>
                        <div class="col-lg-6 col-md-12 mb-4">
                            <a href="{{ route ('admin.users') }}">
                                <div class="p-4 rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Checked-User text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Active Emails</h4>
                                        <span>Total: {{   $data['active_user'] }}</span>
                                    </div>
                                </div>
                            </a>
                            
                        </div>
                        <div class="col-lg-6 col-md-12 mb-4">
                            <a href="{{ route ('admin.users') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Remove-User text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1 ">Unactive Email</h4>
                                    <span>Total: {{   $data['inactive_user'] }}</span>
                                </div>
                                </div>
                            </a>
                            
                        </div>
                        <div class="col-lg-6 col-md-12 mb-4">
                            <a href="{{ route ('admin.setting.role') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Cube-Molecule-2 text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1">Total Roles</h4>
                                    <span>Total: {{   $data['total_roles'] }}</span>
                                </div>
                                </div>
                            </a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0">User Activity</div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-4">
                            <a href="{{ route ('admin.users') }}">
                                <div class="p-4 rounded d-flex align-items-center bg-primary text-white">
                                    <i class="i-Checked-User text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Online Users</h4>

                                        <span>Total: {{   $data['online_user'] }}</span>
                                    </div>
                                </div>
                            </a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <!-- Hr/pro -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3"><h3>Hr Pro</h3></div>
                    <!-- <p class="text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                    
                    <div class="row mt-3">
                        <div class="col-lg-5 col-md-12 mb-4">
                            <div class="card o-hidden">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="flex-grow-1">
                                            <p class="text-15 text-muted m-0">Pending Approvals </p>
                                            <p class="text-24 mb-3"><i class="i-Arrow-Up-in-Circle text-success"></i> {{ $data['total_pending'] }}</p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-15 text-muted m-0">Rejectedd</p>
                                            <p class="text-24 mb-3"><i class="i-Arrow-Down-in-Circle text-danger"></i> {{ $data['total_rejected']  }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">

                                            @if($data['trade_license_pending']!= 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['trade_license_pending']}}</strong> Trade License</p>
                                            <hr>
                                            @endif

                                            @if($data['non_mobile_civil_pending'] + $data['mobile_civil_pending'] != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['non_mobile_civil_pending'] + $data['mobile_civil_pending'] }}</strong> Civial Defence</p>
                                            <hr>
                                            @endif

                                            @if($data['mobile_defence_pending'] + $data['non_mobile_defence_pending'] != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['mobile_defence_pending'] + $data['non_mobile_defence_pending'] }}</strong> Muncipality</p>
                                            <hr>
                                            @endif

                                            @if($data['mobile_individules_pending'] + $data['non_mobile_individules_pending'] != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['mobile_individules_pending'] + $data['non_mobile_individules_pending'] }}</strong> Trained Individual</p>
                                            <hr>
                                            @endif

                                            @if($data['land_contract_pending']  != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['land_contract_pending'] }}</strong> Land Contract</p>
                                            <hr>
                                            @endif

                                            @if($data['office_contract_pending']  != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['office_contract_pending']  }}</strong> Office Contract</p>
                                            @endif
                                        </div>

                                        <div class="col-6">
                                        @if($data['trade_license_rejected']!= 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['trade_license_rejected']}}</strong> Trade License</p>
                                            <hr>
                                            @endif

                                            @if($data['non_mobile_civil_rejected'] + $data['mobile_civil_rejected'] != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['non_mobile_civil_rejected'] + $data['mobile_civil_rejected'] }}</strong> Civial Defence</p>
                                            <hr>
                                            @endif

                                            @if($data['mobile_defence_rejected'] + $data['non_mobile_defence_rejected'] != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['mobile_defence_rejected'] + $data['non_mobile_defence_rejected'] }}</strong> Muncipality</p>
                                            <hr>
                                            @endif

                                            @if($data['mobile_individules_rejected'] + $data['non_mobile_individules_rejected'] != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['mobile_individules_rejected'] + $data['non_mobile_individules_rejected'] }}</strong> Trained Individual</p>
                                            <hr>
                                            @endif

                                            @if($data['land_contract_rejected']  != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['land_contract_rejected'] }}</strong> Land Contract</p>
                                            <hr>
                                            @endif

                                            @if($data['office_contract_rejected']  != 0)
                                            <p class="text-13 text-muted m-0"><strong>{{ $data['office_contract_rejected']  }}</strong> Office Contract</p>
                                            @endif
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 mb-4">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <a href="{{ route ('admin.hr_pro.trade_license__sponsors__partners') }} ">
                                        <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                            <i class="i-Data-Download text-32 mr-3"></i>
                                            <div>
                                                <h4 class="text-18 mb-1 text-white">Total Trade License</h4>
                                                <span>Total: {{ $data['trade_license'] }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route ('admin.hr_pro.office_contracts') }}">
                                        <div class="p-4 rounded d-flex align-items-center bg-primary text-white">
                                            <i class="i-Checked-User text-32 mr-3"></i>
                                            <div>
                                                <h4 class="text-18 mb-1 text-white">OFFICE CONTRACTS</h4>
                                                <span>Total: {{ $data['office_contract']->count() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>      
                        </div>

                      
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('admin.hr_pro.non_mobiles_fuel_tanks_renewals') }}">
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
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('admin.hr_pro.mobiles_fuel_tanks_renewals') }}">
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
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('admin.hr_pro.land_contracts') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Remove-User text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1 ">Land Contracts</h4>
                                    <span>Total: {{ $data['land_contract']->count() }}</span>
                                </div>
                                </div>
                            </a>
                            
                        </div>
                        <div class="col-lg-4 col-md-12 mb-4">
                            <a href="{{ route ('admin.hr_pro.login_access_and_passwords') }}">
                                <div class="p-4 border border-light rounded d-flex align-items-center">
                                <i class="i-Cube-Molecule-2 text-32 mr-3"></i>
                                <div>
                                    <h4 class="text-18 mb-1">Logins and Password</h4>
                                    <!-- <span>Total: </span> -->
                                </div>
                                </div>
                            </a>
                            
                        </div>     
                    </div>
                </div>
            </div>

            <!-- Customer -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3"><h3>Customer</h3></div>
                    <div class="col-lg-5 col-md-5  col-12 mb-4">
                        <div class="card o-hidden">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="flex-grow-1">
                                        <p class="text-15 text-muted m-0">Pending Approvals </p>
                                        <p class="text-24 mb-3"><i class="i-Arrow-Up-in-Circle text-success"></i> {{ $data['total_pending_customer'] }}</p>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-15 text-muted m-0">Rejectedd</p>
                                        <p class="text-24 mb-3"><i class="i-Arrow-Down-in-Circle text-danger"></i> {{ $data['total_rejected_customer']  }}</p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5  col-12 mb-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <a href="{{ route ('admin.customer.customer') }} ">
                                    <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                        <i class="i-Data-Download text-32 mr-3"></i>
                                        <div>
                                            <h4 class="text-18 mb-1 text-white">Total Customer</h4>
                                            <span>Total: {{ $data['total_customer'] }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>      
                    </div>      
                </div>
            </div>

            <!-- Supplier -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3"><h3>Supplier</h3></div>
                    <div class="col-lg-5 col-md-5  col-12 mb-4">
                        <div class="card o-hidden">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="flex-grow-1">
                                        <p class="text-15 text-muted m-0">Pending Approvals </p>
                                        <p class="text-24 mb-3"><i class="i-Arrow-Up-in-Circle text-success"></i> {{ $data['total_pending_supplier'] }}</p>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-15 text-muted m-0">Rejectedd</p>
                                        <p class="text-24 mb-3"><i class="i-Arrow-Down-in-Circle text-danger"></i> {{ $data['total_rejected_supplier']  }}</p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5  col-12 mb-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <a href="{{ route ('admin.supplier.supplier') }} ">
                                    <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                        <i class="i-Data-Download text-32 mr-3"></i>
                                        <div>
                                            <h4 class="text-18 mb-1 text-white">Total Supplier</h4>
                                            <span>Total: {{ $data['total_supplier'] }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>      
                    </div>      
                </div>
            </div>

            <!-- Sub Contractor -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title m-0 mb-3"><h3>Sub Contractor</h3></div>
                    <div class="col-lg-5 col-md-5  col-12 mb-4">
                        <div class="card o-hidden">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="flex-grow-1">
                                        <p class="text-15 text-muted m-0">Pending Approvals </p>
                                        <p class="text-24 mb-3"><i class="i-Arrow-Up-in-Circle text-success"></i> {{ $data['total_pending_sub_contractor'] }}</p>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-15 text-muted m-0">Rejectedd</p>
                                        <p class="text-24 mb-3"><i class="i-Arrow-Down-in-Circle text-danger"></i> {{ $data['total_rejected_sub_contractor']  }}</p>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5  col-12 mb-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <a href="{{ route ('admin.supplier.supplier') }} ">
                                    <div class="p-4 border border-light rounded d-flex align-items-center bg-primary text-white">
                                        <i class="i-Data-Download text-32 mr-3"></i>
                                        <div>
                                            <h4 class="text-18 mb-1 text-white">Sub Contractor</h4>
                                            <span>Total: {{ $data['total_sub_contractor'] }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>      
                    </div>      
                </div>
            </div>

        </div>
    </div>
</div> 
