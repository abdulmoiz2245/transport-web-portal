<style>
    .tabs-page {
  position: relative;
}
.tabs-page > .nav-tabs {
  position: relative;
  min-height: 50px;
  margin: 0;
  padding-left: 15px;
  text-align: left;
  cursor: auto;
  border: none;
  z-index: 1;
}
.tabs-page > .nav-tabs li[role=presentation] {
  display: inline-block;
  height: 50px;
  border: none;
}
.tabs-page > .nav-tabs li[role=presentation]:not(:last-child) {
  padding-right: 22px;
}
.tabs-page > .nav-tabs li[role=presentation] a[role=tab] {
  height: 50px;
  margin: 0;
  padding: 0px;
  font-size: 0.875rem;
  font-weight: 700;
  text-transform: none;
  text-align: center;
  letter-spacing: 0.25px;
  color: #BDC4D0;
  background: none;
  border: none;
  line-height: 50px;
  transition: color 0.3s ease, box-shadow 0.2s ease;
}
.tabs-page > .nav-tabs li[role=presentation] a[role=tab]:hover {
  color: #0075AD;
}
.tabs-page > .nav-tabs li[role=presentation].active a {
  color: #0075AD;
  box-shadow: inset 0 -2px 0 #0075AD;
  background: none;
}
.tabs-page > .nav-tabs li[role=presentation].active a:hover, .tabs-page > .nav-tabs li[role=presentation].active a:focus {
  background: none;
  border: none;
}
.tabs-page > .tab-content {
  position: relative;
  min-height: 500px;
  margin: 0;
  padding: 0;
  background: white;
  border-top: 1px solid #edeef4;
  border-bottom: 1px solid #edeef4;
}

.tabs-secondary {
  position: relative;
  text-align: center;
}
.tabs-secondary > .nav-tabs {
  display: inline-block;
  margin: 0 auto 15px;
  border-bottom: 1px solid #edeef4;
}
.tabs-secondary > .nav-tabs li[role=presentation]:not(:last-child) {
  margin-right: 20px;
}
.tabs-secondary > .nav-tabs li[role=presentation] a[role=tab] {
  padding: 12px 0;
  font-size: 0.6875rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.02rem;
  color: #BDC4D0;
  border: none !important;
  background: none !important;
}
.tabs-secondary > .nav-tabs li[role=presentation] a[role=tab]:hover {
  color: #0075AD;
}
.tabs-secondary > .nav-tabs li.active a[role=tab] {
  color: #0075AD;
  background: none;
  box-shadow: inset 0 -2px 0 0 #0075AD;
}
</style>
<!-- Tabs - Page -->
<div class="tabs-page">
    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Fuel</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tyres</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Spare Parts</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Tools</a></li>
    </ul><!-- ./ nav tabs -->
</div><!-- ./ tabs page -->
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.inventory.fuel') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35">
                                <p class="text-muted mt-2 mb-2"><strong>Fuel</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.inventory.tyres') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/tyre.png" class="mb-1" alt="" width="35">
                                <p class="text-muted mt-2 mb-2"><strong>Tyres</strong></p>
                                <p class="lead text-22 m-0">{{ $data['total_tyre'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.inventory.spare_parts') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/spare-parts.png" alt="" class="mb-1" width="35">
                                <p class="text-muted mt-2 mb-2"><strong>Spare Parts</strong></p>
                                <p class="lead text-22 m-0">{{ $data['total_spare_part'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.inventory.tools') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/tools.png" alt="" class="mb-1" width="35">
                                <p class="text-muted mt-2 mb-2"><strong>Tools</strong></p>
                                <p class="lead text-22 m-0">{{ $data['total_tools'] }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.inventory.uncategorized') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/tools.png" alt="" class="mb-1" width="35">
                                <p class="text-muted mt-2 mb-2"><strong>Uncategorized  Purchased Data</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>