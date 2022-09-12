<div class="container card">
    <div class="mb-3">
            <a href="{{ route('admin.operations') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            
    </div>
    <form action="{{ route('admin.operations.save_employee_attendance') }}" method="post">
            @csrf
            <input type="text" name="date" value="{{  $data['date'] }}" class="d-none">
            <div class="table-responsive">
                <table id=""  class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Designation</th>  
                            <th>Status</th>  
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data['employee'] as $employee)
                        @if($employee->employee_doj != '' && $employee->status== 'approved')
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td> {{ $employee->name }}</td>
                            <td>{{ $employee->designation_actual }}</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" name="attendance['{{ $employee->id }}']" value="p" checked="true">
                                    <label class="form-check-label" for="inlineCheckbox1">P</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="attendance['{{ $employee->id }}']"  type="radio" id="inlineCheckbox2" value="a">
                                    <label class="form-check-label" for="inlineCheckbox2">A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="attendance['{{ $employee->id }}']" type="radio" id="inlineCheckbox3" value="l" >
                                    <label class="form-check-label" for="inlineCheckbox3">L</label>
                                </div>
                            </td>

                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="text-center mt-3">
                    <input type="submit" name="submit" id="" class="btn btn-primary">
                </div>
            </div>
            
    </form>
</div>