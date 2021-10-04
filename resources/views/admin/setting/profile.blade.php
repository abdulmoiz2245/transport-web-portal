@section('css')
    <link rel="stylesheet" href="<?= asset('assets') ?>/styles/css/setting.css">
@show
<div class="container emp-profile">
            <form action="{{ route('admin.update.profile') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row ">
                    <div class="col-md-4">
                        <div class="profile-img">
                            @if (Auth::user()->profile_pic != '' )
                            <img id="profile_pic" src=" <?php echo  asset('main_admin/profile') ?>/{{ Auth::user()->profile_pic }}" alt="{{ Auth::user()->profile_pic }}" />
                            @else 
                            <img id="profile_pic" src="<?php echo  asset('main_admin/profile') ?>/no_image.jpg" alt="no-img" />
                            @endif
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="image" onchange="readURL1(this);"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="profile-head">
                            <h4>
                            {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}
                            </h4>
                            <h6>@ {{ Auth::user()->username }}</h6>
                                    
                            <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                            <ul class="nav nav-tabs mt-5 pt-5" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> <i class="i-Lock" style="
                                        font-size: 17px;
                                    "></i> Change Password</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                            <input class="form-control form-control-rounded" type="text" name="username" value="{{ Auth::user()->username }}" >
                                            </div>
                                        </div>
                                        <div class="row  mb-3">
                                            <div class="col-md-3">
                                                <label>First Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-rounded" type="text" name="first_name" value="{{ Auth::user()->f_name }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label>Last Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-rounded" type="text" name="last_name" value="{{ Auth::user()->l_name }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-rounded" type="text" name="email" value="{{ Auth::user()->email }}" >
                                            </div>
                                        </div>
                                       
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Previous Password</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-control-rounded" type="password" name="old_password" value="" >
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>New Password</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-control-rounded" type="password" name="new_password" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Repeat New Password</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-control-rounded" type="password" name="repeat_new_password" value="" >
                                        </div>
                                    </div>
                                    
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                        <input type="submit" class="btn btn-secondary btn-rounded m-1" name="btnAddMore" value="Update Profile"/>
                    </div>
            </form>           
        </div>

        <script>
            function readURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    console.log("working");
                    reader.onload = function (e) {
                        $('#profile_pic')
                            .attr('src', e.target.result);
                            
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>