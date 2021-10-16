<div class="mb-5"> 
    <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners') }}">
        <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
    </a>
</div>
<div class="container">
    <form action="{{ route('admin.hr_pro.save_company') }}" method="post">
    @csrf
        <div class="form-group">
           
            <label for="exampleInputEmail1">Company Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Company Name" required>
            
        </div>
        
        <button type="submit" class="btn btn-primary">Add Company</button>
    </form>
</div>