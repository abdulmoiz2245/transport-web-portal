<?php 
use App\Models\Company_name;
use App\Models\Civil_defense_documents;
use App\Models\User;


?>
<div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'user.inventory') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tools.tools_in_storage') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tyre.png" class="mb-1" alt="" width="35">
                        <h4 class="mt-2 mb-2"><strong>Tools in Storage</strong></h4>
                        <p class="lead text-22 m-0">{{ $data['tools_in_storage']}}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tools.tools_entry') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tyre.png"  alt="" width="40">
                        <h4 class="mt-2 mb-2"><strong>Tools Entry</strong></h4>
                        <p class="lead text-22 m-0">{{ $data['tools_entry']}}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

