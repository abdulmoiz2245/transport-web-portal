<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.inventory.uncategorized') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""><b>Date:</b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Product Name : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->product_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Quantity : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->quantity }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Made In : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->made_in }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Brand : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->brand }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Size : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->size }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Unit : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->unit }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""><b>Po Number of Purchase :</b></h5>
                </div>
                <div class="col-6">
                    <p>{{ $data['uncategorized']->po_number }}</p>
                </div>
            </div>
        </div>
    </div>
</div>