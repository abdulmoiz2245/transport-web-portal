<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Invoice</a></li>
            <!-- <li class="nav-item"><a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a></li> -->
        </ul>
        <div class="card">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                    <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                        <button class="btn btn-primary mb-sm-0 mb-3 print-invoice" onclick="window.print()">Print Invoice</button>
                    </div>
                    <form action="{{ route( 'admin.account.save_invoice') }}" method="post">
                        @csrf
                    <!-- -===== Print Area =======-->
                    <div id="print-area">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="font-weight-bold">Invoice Number</h4>
                                <p>
                                    <?php 
                                        $rand_no = mt_rand(100000,999999);
                                    ?>
                                    INV-{{ $rand_no }}
                                    <input type="text" name="invoice_no" class="d-none" value="{{ $rand_no }}" >
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 class="font-weight-bold">Cash/Credit Tax Invoice</h4>
                                <!-- <p>#106</p> -->
                            </div>
                            <div class="col-md-4 text-sm-right">
                                <h4 class="font-weight-bold">Invoice Date</h4>
                                <p><?= date('Y-m-d') ?></p>
                            </div>
                        </div>
                        <div class="mt-3 mb-4 border-top"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="font-weight-bold">Company Name</h6>
                                <p>
                                    <?php if($data['company_names']->count() > 0){ ?>
                                            <?php $check = 0; ?>
                                        @foreach($data['company_names'] as $company_name)
                                            @if($company_name->id == $data['customer']->company_id)
                                                <?php $check = 1 ?>
                                                {{ $company_name->name}}
                                                <input type="text" name="company_id" class="d-none" value="{{ $company_name->id }}" >

                                            @endif
                                        @endforeach
                                        <?php if($check == 0){ ?>
                                            <span class="badge badge-pill badge-danger p-2 m-1">Nill</span>
                                        <?php } ?>
                                
                                    <?php }else{ ?>
                                            <span class="badge badge-pill badge-danger p-2 m-1">Nill</span>
                                        <?php } ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <h6 class="font-weight-bold">Customer Name </h6>
                                <p> {{ $data['customer']->name }}
                                    <input type="text" name="customer_name" class="d-none" value="{{ $data['customer']->name }}" >
                                    <input type="text" name="customer_id" class="d-none" value="{{ $data['customer']->id }}" >
                                
                                </p>
                            </div>
                            <div class="col-md-4 text-sm-right">
                                <h6 class="font-weight-bold">TRN</h6>
                                <p><?= $data['customer']->trn ?>
                                <input type="text" name="trn" class="d-none" value="{{ $data['customer']->trn }}" >
                            </p>
                            </div>
                        </div>
                        <div class="mt-3 mb-4 border-top"></div>

                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-sm-0">
                                <h5 class="font-weight-bold">Invoice From</h5>
                                <p>{{ $data['from_date'] }}
                                <input type="text" name="from_date" class="d-none" value="{{ $data['from_date'] }}" >

                                </p>
                            </div>
                            <div class="col-md-6 text-sm-right">
                                <h5 class="font-weight-bold">To Date</h5>
                                <p>{{ $data['to_date'] }}</p>
                                <input type="text" name="to_date" class="d-none" value="{{ $data['to_date'] }}" >

                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="table-responsive">
                                <table class="table table-hover mb-4">
                                    <thead class="bg-gray-300">
                                        <tr>
                                            <th scope="col">Job Id</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Delivery Date</th>
                                            <th scope="col">Vehicle No</th>
                                            <th scope="col">Deten</th>
                                            <th scope="col">Deten Rate</th>

                                            <th scope="col">Toll </th>
                                            <th scope="col">Gate </th>
                                            <th scope="col">Labour </th>
                                            <th scope="col">Border </th>
                                            <th scope="col">Other </th>
                                            <th scope="col">Price</th>

                                            <th scope="col">Amount </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['booking'] as $booking)
                                            <tr id="row-{{ $booking->id }}">
                                                <td>{{ $booking->id}}
                                                <input type="text" name="job_id[]" class="d-none" value="{{ $booking->id }}" >
                                                </td>
                                                <td>{{ $booking->from_location}}
                                                <input type="text" name="from_location[]" class="d-none" value="{{ $booking->from_location }}" >
                                                </td>
                                                <td>{{ $booking->to_location}}
                                                <input type="text" name="to_location[]" class="d-none" value="{{ $booking->to_location }}" >
                                                </td>
                                                <td>{{ $booking->offloading_date}}
                                                <input type="text" name="offloading_date[]" class="d-none" value="{{ $booking->offloading_date }}" >
                                                <input type="text" name="loading_date[]" class="d-none" value="{{ $booking->loading_date }}" >
                                                <input type="text" name="booking_date[]" class="d-none" value="{{ $booking->booking_date }}" >

                                                </td>
                                                <td> 
                                                    @foreach($data['vehicle'] as $vehicle)
                                                        @if($vehicle->id == $booking->vehicle_id)
                                                            {{ $vehicle->vehicle_number}}
                                                        @endif
                                                    @endforeach
                                                <input type="text" name="vehicle_id[]" class="d-none" value="{{ $booking->vehicle_id }}" >

                                                </td>
                                                <td id="col-deten">
                                                    
                                                    <select name="detention_type[]" job-id='{{ $booking->id }}' rate-id='{{ $booking->rate_card_id }}' class="form-control deten_type">
                                                        <option value="per_day">Per Day</option>
                                                        <option value="per_hour">Per Hour</option>
                                                    </select>
                                                    <input name="detention_duration[]" rate-id='{{ $booking->rate_card_id }}' job-id='{{ $booking->id }}' id="deten-rate-duration-{{ $booking->rate_card_id }}" type="number" class=" deten-rate-duration form-control" value="0">
                                                    
                                                
                                                </td>

                                                <td id="col-deten-rate-{{ $booking->rate_card_id }}">
                                                    0

                                                </td>
                                                <input name="detention_rate[]"  id="deten-rate-{{ $booking->rate_card_id }}" type="number" class="d-none deten-rate form-control" value="0">

                                                <td class="" id="col-toll-charges-{{ $booking->id }}">
                                                    {{ $booking->toll_charges}}
                                                </td>
                                                <input name="toll_charges[]"  id="toll-charges-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->toll_charges}}">

                                                <td class="" id="col-gate-charges-{{ $booking->id }}">
                                                    {{ $booking->gate_charges}}
                                                    
                                                </td>
                                                <input name="gate_charges[]"  id="gate-charges-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->gate_charges}}">

                                                <td class="" id="col-labour-charges-{{ $booking->id }}">{{ $booking->labour_charges}}</td>
                                                <input name="labour_charges[]"  id="labour-charges-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->labour_charges}}">

                                                <td class="" id="col-border-charges-{{ $booking->id }}"> {{ $booking->border_charges}}</td>
                                                <input name="border_charges[]"  id="border-charges-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->border_charges}}">
                                                
                                                <td class="" id="col-other-charges-{{ $booking->id }}">{{ $booking->other_charges}}</td>
                                                <input name="other_charges[]"  id="other-charges-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->other_charges}}">
                                                <input name="other_charges_description[]"  id="other-charges-description-{{ $booking->id }}" type="text" class="d-none form-control" value="{{ $booking->other_charges_description}}">

                                                <td id="col-rate-price-{{ $booking->id }}" >
                                                    @foreach($data['customer_rate_card'] as $rate_card)
                                                        @if($rate_card->id == $booking->rate_card_id)
                                                            <?php
                                                                $start = strtotime(date("Y-m-d",strtotime($booking->loading_date))); // or your date as well
                                                                $end = strtotime(date("Y-m-d",strtotime($booking->offloading_date)));
                                                                $datediff = $start - $end;
                                                                $earlier = new DateTime($booking->loading_date);
                                                                $later = new DateTime($booking->offloading_date);

                                                                $abs_diff = $later->diff($earlier)->format("%a");
                                                                echo $abs_diff*(int)$rate_card->rate_price;
                                                            ?>
                                                        <input name="job_price[]"  id="rate-price-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $abs_diff*(int)$rate_card->rate_price }}">

                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td id="col-total-amount-{{ $booking->id }}" class="total-price">0</td>
                                                <input name="total_amount[]"  id="total-amount-{{ $booking->id }}" type="number" class="d-none form-control" value="0">

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice-summary">
                                    <input name="sub_total_amount"  id="sub-total-amount-input" type="float" class="d-none form-control" value="0">
                                    <input name="vat_amount"  id="vat-amount-input" type="float" class="d-none form-control" value="0">
                                    <input name="grand_total"  id="grand-total-amount-input" type="float" class="d-none form-control" value="0">

                                    <p>Sub total: <span class="sub-total-amount">0</span></p>
                                    <p>Vat (5%): <span  class="vat-amount">0</span></p>
                                    <h5 class="font-weight-bold">Grand Total: <span class="grand-total">0</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ==== / Print Area =====-->
                    @if(count($data['booking']) > 1)
                    <button id="submit-invoice" type="submit" class="btn btn-primary">Save Invoice</button>
                    @endif
                    </form>
                </div>
                <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                    <!-- ==== Edit Area =====-->
                    <div class="d-flex mb-5"><span class="m-auto"></span>
                        <button class="btn btn-primary">Save</button>
                    </div>
                    <form>
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h4 class="font-weight-bold">Order Info</h4>
                                <div class="col-sm-4 form-group mb-3 pl-0">
                                    <label for="orderNo">Order Number</label>
                                    <input class="form-control" id="orderNo" type="text" placeholder="Enter order number">
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <label class="d-none text-12 text-muted">Order Status</label>
                                <div class="pr-0 mb-4">
                                    <label class="radio radio-reverse radio-danger">
                                        <input type="radio" name="orderStatus" value="Pending"><span>Pending</span><span class="checkmark"></span>
                                    </label>
                                    <label class="radio radio-reverse radio-warning">
                                        <input type="radio" name="orderStatus" value="Processing"><span>Processing</span><span class="checkmark"></span>
                                    </label>
                                    <label class="radio radio-reverse radio-success">
                                        <input type="radio" name="orderStatus" value="Delivered"><span>Delivered</span><span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="order-datepicker">Order Date</label>
                                    <input class="form-control text-right" id="order-datepicker" placeholder="yyyy-mm-dd" name="dp">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-4 border-top"></div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold">Bill From</h5>
                                <div class="col-md-10 form-group mb-3 pl-0">
                                    <input class="form-control" id="billFrom3" type="text" placeholder="Bill From">
                                </div>
                                <div class="col-md-10 form-group mb-3 pl-0">
                                    <textarea class="form-control" placeholder="Bill From Address"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5 class="font-weight-bold">Bill To</h5>
                                <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                    <input class="form-control text-right" id="billFrom2" type="text" placeholder="Bill From">
                                </div>
                                <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                    <textarea class="form-control text-right" placeholder="Bill From Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-hover mb-3">
                                    <thead class="bg-gray-300">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Cost</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <input class="form-control" value="Product 1" type="text" placeholder="Item Name">
                                            </td>
                                            <td>
                                                <input class="form-control" value="300" type="number" placeholder="Unit Price">
                                            </td>
                                            <td>
                                                <input class="form-control" value="2" type="number" placeholder="Unit">
                                            </td>
                                            <td>600</td>
                                            <td>
                                                <button class="btn btn-outline-secondary float-right">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>
                                                <input class="form-control" value="Product 1" type="text" placeholder="Item Name">
                                            </td>
                                            <td>
                                                <input class="form-control" value="300" type="number" placeholder="Unit Price">
                                            </td>
                                            <td>
                                                <input class="form-control" value="2" type="number" placeholder="Unit">
                                            </td>
                                            <td>600</td>
                                            <td>
                                                <button class="btn btn-outline-secondary float-right">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-primary float-right mb-4">Add Item</button>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice-summary invoice-summary-input float-right">
                                    <p>Sub total: <span>$1200</span></p>
                                    <p class="d-flex align-items-center">Vat(%):<span>
                                            <input class="form-control small-input" type="text" value="10">$120</span></p>
                                    <h5 class="font-weight-bold d-flex align-items-center">Grand Total:<span>
                                            <input class="form-control small-input" type="text" value="$">$1320</span></h5>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- ==== / Edit Area =====-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function job_total_calculate(job_id , rate_card_id){
        var deten_rate = Number($('#col-deten-rate-'+rate_card_id).text());
        var toll_charges = Number($('#col-toll-charges-'+job_id).text());
        var labour_charges = Number($('#col-labour-charges-'+job_id).text());
        var gate_charges = Number($('#col-gate-charges-'+job_id).text());
        var border_charges = Number($('#col-border-charges-'+job_id).text());
        var other_charges = Number($('#col-other-charges-'+job_id).text());
        var rate_price = Number($('#col-rate-price-'+job_id).text());

        var total = deten_rate + toll_charges + labour_charges + gate_charges + border_charges + other_charges + rate_price;
        // console.log(deten_rate);
        $('#col-total-amount-'+job_id).html(total);
        $('#total-amount-'+job_id).val(total);
    }

    function total_price(){
        var total = $('.total-price');
        var sub_total = 0;
        var gross_total = 0;

        var vat = 0;
      
        for (var i = 0; i < total.length; i++) {
            sub_total += Number(total[i].innerText);
        }

        vat = (5 / 100) * sub_total;
        gross_total = vat + sub_total;

        $('.sub-total-amount').text(sub_total);
        $('.vat-amount').text(vat);
        $('.grand-total').text(gross_total);

        $('#sub-total-amount-input').val(sub_total);
        $('#vat-amount-input').val(vat);
        $('#grand-total-amount-input').val(gross_total);
    }

    function post_to_url(path, params, method) {
        method = method || "post";

        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        form.submit();
    }

    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }

    $(document).ready(function() {
        var rate_card = <?php echo json_encode($data['customer_rate_card']); ?>;
        $('.deten_type').on('change', function(){
           var booking_rate_id = $(this).attr('rate-id')
           var job_id = $(this).attr('job-id')

            if(this.value == "per_day"){
                rate_card.forEach(element => {
                    if(element.id == booking_rate_id ){
                        var duration = $('#deten-rate-duration-'+booking_rate_id).val();
                        var rate = duration * element.detention_charges_days;
                        // console.log(duration);
                        $('#col-deten-rate-'+booking_rate_id).html(rate);
                        $('#deten-rate-'+booking_rate_id).val(rate);

                    }
                });
            }else if(this.value == "per_hour"){
                rate_card.forEach(element => {
                    if(element.id == booking_rate_id ){
                        var duration = Number($('#deten-rate-duration-'+booking_rate_id).val());
                        var rate = duration * element.detention_charges_hours;
                        $('#col-deten-rate-'+booking_rate_id).html(rate);
                        $('#deten-rate-'+booking_rate_id).val(rate);

                    }
                });
            }

            job_total_calculate(job_id , booking_rate_id);
            total_price();
        });
        
        $('.deten-rate-duration').on('change', function(){
            var booking_rate_id = $(this).attr('rate-id')
            var job_id = $(this).attr('job-id')

            var dten_type = $('.deten_type').val();
            if(dten_type == "per_day"){
                rate_card.forEach(element => {
                    if(element.id == booking_rate_id ){
                        var duration = $('#deten-rate-duration-'+booking_rate_id).val();
                        var rate = duration * element.detention_charges_days;
                        $('#col-deten-rate-'+booking_rate_id).html(rate);
                        $('#deten-rate-'+booking_rate_id).val(rate);

                    }
                });
            }else if(dten_type == "per_hour"){
                rate_card.forEach(element => {
                    if(element.id == booking_rate_id ){
                        var duration = Number($('#deten-rate-duration-'+booking_rate_id).val());
                        var rate = duration * element.detention_charges_hours;
                        $('#col-deten-rate-'+booking_rate_id).html(rate);
                        $('#deten-rate-'+booking_rate_id).val(rate);

                    }
                });
            }
            job_total_calculate(job_id , booking_rate_id);
            total_price();

        });

    });
</script>