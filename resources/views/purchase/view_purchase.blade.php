<?php 
use App\Models\Company_name;
use App\Models\Purchase_mertial_data;
use App\Models\Supplier_info;

?>
<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.purchase.purchase') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <h2 class="mb-3">LPO</h2>
    <div class="row mb-3">
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Date : </h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['purchase']->date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">PO Number : </h5>

                </div>
                <div class="col-6">
                    @if($data['purchase']->po_number != null)
                    <p>{{ $data['purchase']->po_number }}</p>
                    @else
                    <p>Not Assigned </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">TRN Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['purchase']->trn }}</p>                   
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Company Name :</h5>

                </div>
                <div class="col-6">
                    
                    <?php if(Company_name::all()->count() > 0){ ?>
                    @foreach(Company_name::all() as $company_name)
                        @if($company_name->id ==  $data['purchase']->company_id)
                            <p>{{ $company_name->name }}</p>
                        @endif
                    @endforeach
                    <?php } ?>
                
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Company Address :</h5>
                </div>

                <div class="col-8">                   
                    <p>{{ $data['purchase']->company_address }}</p>   
                </div>
            </div>
        </div> -->
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Material Data :</h5>
                </div>
                <div class="col-8"> 
                        @if(Purchase_mertial_data::find($data['purchase']->meterial_data_id ) != null)    
                        <p> {{ Purchase_mertial_data::find($data['purchase']->meterial_data_id )->name }}</p> 
                        @else
                        <p>Meterial Deleted</p>
                        @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Supplier Name :</h5>
                </div>
                <div class="col-8"> 
                        @if($data['purchase']->supplier_status == 'new')
                        <p> {{ $data['purchase']->supplier_name }}</p> 
                        @elseif(Supplier_info::find($data['purchase']->supplier_id ) != null)    
                        <p> {{ Supplier_info::find($data['purchase']->supplier_id )->name }}</p> 
                        @else
                        <p>Supplier Deleted</p>
                        @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Type :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->type }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Made In :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->made_in }}</p>  
                </div>
            </div>
        </div> 
       
        
        <div class="col-12">
            <hr>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Product Name :</h5>
                </div>
                <div class="col-8">
                    <p> {{ $data['purchase']->product_name }} </p>  
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Brand :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->brand }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Size :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->size }}</p>  
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Unit :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->unit }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Unit Price :</h5>
                </div>
                <div class="col-8">
                    <p> {{ $data['purchase']->unit_price }} </p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Delivery Date :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['purchase']->delivery_date  }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Terms :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['purchase']->terms  }}</p>  
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Credit Days :</h5>
                </div>
                <div class="col-8">
                    <p> {{$data['purchase']->cerdit_days  }}</p>  
                </div>
            </div>
        </div> -->
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Total Amount :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['purchase']->total_amount  }}</p>  
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>