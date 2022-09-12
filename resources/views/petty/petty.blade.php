<?php 
use App\Models\Petty;
use App\Models\Petty_hr;

use App\Models\Petty_bills;
use App\Models\Petty_purchase;
use App\Models\petty_booking;

$petty = Petty::latest()->first();
$circulating_cash = 0;

if($petty!= null){
    $avalible_cash = $petty->total_amount;
    
    foreach(Petty_purchase::all() as $purchase){
        if($purchase->amount_paid > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount_paid;
        }
    }

    foreach(Petty_hr::all() as $purchase){
        if($purchase->amount_paid > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount_paid;
        }
    }

    foreach(Petty_bills::all() as $purchase){
        if($purchase->amount > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount;
        }
    }
    foreach(Petty_booking::all() as $purchase){
        if($purchase->amount > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount;
        }
    }


}else{
    $avalible_cash = 0;
}
 ?>
<div class="container">
    <div class="row mt-4 mb-4">
        <!-- ICON BG-->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title"> Avalible Cash</h4>   
                    <p class="text-primary text-24 line-height-1">{{ $avalible_cash }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title">Circulating Cash</h4>   
                    <p class="text-primary text-24 line-height-1">{{ $circulating_cash}} </p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'user.petty.payable_purchase') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Petty Cash Entry</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'user.petty.petty_detail') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Detail </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'user.petty.finance_request') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Request for Finances</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'user.account.approval') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Approvals </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
