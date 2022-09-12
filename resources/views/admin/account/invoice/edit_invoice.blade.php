<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Invoice</a></li>
        </ul>
        <div class="card">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                    <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                        <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>
                    </div>
                    <form action="{{ route( 'admin.account.update_invoice') }}" method="post">
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
                                    INV-{{  $data['invoice']->invoice_no }}
                                    <input type="text" name="invoice_id" class="d-none" value="{{ $data['invoice']->id }}" >

                                    <input type="text" name="invoice_no" class="d-none" value="{{ $data['invoice']->invoice_no }}" >
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 class="font-weight-bold">Cash/Credit Tax Invoice</h4>
                                <!-- <p>#106</p> -->
                            </div>
                            <div class="col-md-4 text-sm-right">
                                <h4 class="font-weight-bold">Invoice Date</h4>
                                <p>{{  $data['invoice']->date }}</p>
                                <input type="date" name="date" class="d-none" value="{{ $data['invoice']->date }}" >

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
                                <p>{{ $data['invoice']->from_date }}
                                <input type="text" name="from_date" class="d-none" value="{{ $data['invoice']->from_date }}" >

                                </p>
                            </div>
                            <div class="col-md-6 text-sm-right">
                                <h5 class="font-weight-bold">To Date</h5>
                                <p>{{ $data['invoice']->to_date }}</p>
                                <input type="text" name="to_date" class="d-none" value="{{ $data['invoice']->to_date }}" >

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
                                                        <option value="per_day" <?php if($booking->detention_type == 'per_day') {?> selected <?php } ?>>Per Day</option>
                                                        <option value="per_hour" <?php if($booking->detention_type == 'per_hour') {?> selected <?php } ?>>Per Hour</option>
                                                    </select>
                                                    <input name="detention_duration[]" rate-id='{{ $booking->rate_card_id }}'
                                                     job-id='{{ $booking->id }}' id="deten-rate-duration-{{ $booking->rate_card_id }}"
                                                      type="number" class=" deten-rate-duration form-control" value="{{ $booking->detention_duration }}">
                                                    
                                                
                                                </td>

                                                <td id="col-deten-rate-{{ $booking->rate_card_id }}">
                                                {{ $booking->detention_rate }}

                                                </td>
                                                <input name="detention_rate[]"  id="deten-rate-{{ $booking->rate_card_id }}" type="number" class="d-none deten-rate form-control" value="$booking->detention_rate">

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
                                                <input name="other_charges_description[]"  id="other-charges-description-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->other_charges_description}}">

                                                <td id="col-rate-price-{{ $booking->id }}" >
                                                        {{ $booking->job_price}}
                                                        <input name="job_price[]"  id="rate-price-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $$booking->job_price }}">

                                                   
                                                </td>
                                                <td id="col-total-amount-{{ $booking->id }}" class="total-price">{{ $booking->total_amount }}</td>
                                                <input name="total_amount[]"  id="total-amount-{{ $booking->id }}" type="number" class="d-none form-control" value="{{ $booking->total_amount }}">

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice-summary">
                                    <input name="sub_total_amount"  id="sub-total-amount-input" type="float" class="d-none form-control" value="{{ $invoice->sub_total_amount }}">
                                    <input name="vat_amount"  id="vat-amount-input" type="float" class="d-none form-control" value="{{ $invoice->vat_amount }}">
                                    <input name="grand_total"  id="grand-total-amount-input" type="float" class="d-none form-control" value="{{ $invoice->grand_total }}">

                                    <p>Sub total: <span class="sub-total-amount">{{ $invoice->sub_total_amount }}</span></p>
                                    <p>Vat (5%): <span  class="vat-amount">{{ $invoice->vat_amount }}</span></p>
                                    <h5 class="font-weight-bold">Grand Total: <span class="grand-total">{{ $invoice->grand_total }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ==== / Print Area =====-->
                    <button id="submit-invoice" type="submit" class="btn btn-primary">Update Invoice</button>
                    </form>
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