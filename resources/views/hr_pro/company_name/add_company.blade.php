<div class="container">
    <form action="{{ route('user.hr_pro.save_company') }}" method="post">
    @csrf
        <div class="form-group">
           
            <label for="exampleInputEmail1">Company Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Company Name" required>
            
        </div>
        
        <button type="submit" class="btn btn-primary">Add Company</button>
    </form>
</div>
<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>