<?php 
    use App\Models\Purchase_mertial_data;

?>
<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.purchase') }}">
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
                    <p>{{ $data['purchase']->company_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Company Address :</h5>
                </div>

                <div class="col-8">                   
                    <p>{{ $data['purchase']->company_address }}</p>   
                </div>
            </div>
        </div>
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
            <h4 class="w-100">For Stock</h4>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">For Stock :</h5>
                </div>
                <div class="col-8">
                    <p> @if($data['purchase']->for_stock == 0)
                            NO
                        @else
                            Yes
                        @endif
                    </p>  
                </div>
            </div>
        </div>
        @if($data['purchase']->for_stock == 0)
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Number :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->vechicle_num }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Description :</h5>
                </div>
                <div class="col-8">
                    <p> {{ $data['purchase']->stock_description }}</p>  
                </div>
            </div>
        </div>
        @endif
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
                    <h5 class="">Quantity :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['purchase']->quantity }}</p>  
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
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Credit Days :</h5>
                </div>
                <div class="col-8">
                    <p> {{$data['purchase']->cerdit_days  }}</p>  
                </div>
            </div>
        </div>
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