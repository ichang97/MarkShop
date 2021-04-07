@extends('layouts.app')

@section('content')
<div class="container">
<button class="btn btn-success shadow-sm" data-toggle="modal" data-target="#add_producttype"><i class="fa fa-plus"></i> Add product type</button><br /><br />

<div class="modal fade" tabindex="-1" role="dialog" id="add_producttype">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><i class="fa fa-plus"></i> Add product type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('product_types.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label>Product type name</label>
                <input class="form-control" type="text" id="txt_typename" name="txt_typename" required>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block" type="submit" id="btn_save"><i class="fa fa-plus"></i> Add</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    @php
        $rows = 2; $count = 0;
    @endphp
    <div class="row row-cols-2">
    @foreach($product_types as $item)
        <div class="col">
            <div class="alert alert-primary shadow text-center">
                <i class="fas fa-list-ul" style="font-size: 100px;"></i>
                <h3 class="h3">{{$item->type_name}}</h3>
            </div>
        </div>
    @php
        $count++;
    @endphp

    @if ($count % $rows == 0)
    </div><div class="row row-cols-2">    
    @endif

    @endforeach
    
    @if(session('result'))
        <script>
            Swal.fire(
                "{{session('result.title')}}",
                "{{session('result.msg')}}",
                "{{session('result.type')}}"
            )
        </script>
    @endif
</div>
@endsection