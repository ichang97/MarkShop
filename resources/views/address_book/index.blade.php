@extends('layouts.app')

@section('content')
<div class="container">
@if(session('result'))
<script>
    Swal.fire(
        "{{session('result.title')}}",
        "{{session('result.msg')}}",
        "{{session('result.type')}}"
    )
</script>
@endif
    <button class="btn btn-success" id="btn_add_address" data-toggle="modal" data-target="#add_address"><i class="fa fa-plus"></i> Add address</button><br /><br />
    <div class="modal fade" tabindex="-1" role="dialog" id="add_address">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success text-white">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Add address</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('address_book.store')}}" method="POST" id="frm_add_address">
                @csrf
                @method('POST')

                <div class="form-group">
                    <b><label>Address name <i>Home, Office etc.</i></label></b>
                    <input class="form-control" type="text" id="txt_addressname" name="txt_addressname" required>
                </div>
                <div class="form-group">
                    <label>Receiver Name</label>
                    <input class="form-control" type="text" id="txt_receiver_name" name="txt_receiver_name" required>
                </div>
                <div class="form-group">
                    <label>House No.</label>
                    <input class="form-control" type="text" id="txt_hourseno" name="txt_hourseno" required>
                </div>
                <div class="form-group">
                    <label>Building Name</label>
                    <input class="form-control" type="text" id="txt_buildingname" name="txt_buildingname" placeholder="Optional">
                </div>
                <div class="form-group">
                    <label>Floor No.</label>
                    <input class="form-control" type="text" id="txt_floorno" name="txt_floorno" placeholder="Optional">
                </div>
                <div class="form-group">
                    <label>Street / Road</label>
                    <input class="form-control" type="text" id="txt_street" name="txt_street" required>
                </div>
                <div class="form-group">
                    <label>Sub-District</label>
                    <input class="form-control" type="text" id="txt_sub_district" name="txt_sub_district" required>
                </div>
                <div class="form-group">
                    <label>District</label>
                    <input class="form-control" type="text" id="txt_district" name="txt_district" required>
                </div>
                <div class="form-group">
                    <label>Province</label>
                    <input class="form-control" type="text" id="txt_province" name="txt_province" required>
                </div>
                <div class="form-group">
                    <label>Postal Code</label>
                    <input class="form-control" type="text" id="txt_postal_code" name="txt_postal_code" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block" id="btn_save" type="submit"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>

    <div class="card border-primary shadow">
        <div class="card-header bg-primary text-white">
        My Address book.
        </div>
        <div class="card-body">
            @if(count($address) != 0)
            <div class="row row-cols-3">
                @php
                    $rows = 3; $count = 0;
                @endphp
                @foreach ($address as $item)
                <div class="col">
                    <div class="card border-info">
                        <div class="card-header">
                            {{$item->address_name}}
                            @if($item->default === 1)
                            <div class="float-right">
                                <span class="text-success"><i class="fas fa-check-circle"></i> Default</span>
                            </div>
                            @else
                            <div class="float-right">
                                <button class="btn btn-sm btn-success" id="btn_set_default{{$item->id}}"><i class="fas fa-check-circle"></i> Set Default</button>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            {{$item->receiver_name}}<br />
                            {{$item->home_number}} 
                            @if($item->building_name != '' && $item->floor_no != '')
                                อาคาร {{$item->building_name}} ชั้น {{$item->floor_no}}<br />
                            @endif
                            {{$item->street}}<br />
                            แขวง/ตำบล {{$item->sub_district}} เขต/อำเภอ {{$item->district}}<br />
                            จังหวัด {{$item->province}} รหัสไปรษณีย์ {{$item->postal_code}}
                        </div>
                    </div>
                </div>
                @php
                    $count++;
                @endphp
                @if($count % $rows == 0)
            </div><div class="row row-cols-3">
                @endif
            @endforeach

            @else
                <div class="alert alert-warning text-center"><h5>No data.</h5>
            @endif
        </div>
    </div>
    
</div>
<script>
    $.Thailand({
        $district: $('#txt_sub_district'),
        $amphoe: $('#txt_district'), 
        $province: $('#txt_province'), 
        $zipcode: $('#txt_postal_code'),
    });
</script>
@endsection