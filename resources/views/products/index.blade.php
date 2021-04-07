@extends('layouts.app')

@section('content')
<div class="container">
@if (session('result'))
  <script>
    Swal.fire(
      "{{session('result.title')}}",
      "{{session('result.msg')}}",
      "{{session('result.type')}}"
    )
</script>
@endif

<button class="btn btn-success shadow-sm" data-toggle="modal" data-target="#add_product"><i class="fa fa-plus"></i> Add product</button><br /><br />

<div class="modal fade" tabindex="-1" role="dialog" id="add_product">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><i class="fa fa-plus"></i> Add product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('products.store')}}" method="POST" id="frm_addproduct">
            @csrf

            <div class="form-group">
                <label>Product code</label>
                <input class="form-control" type="text" id="txt_productcode" name="txt_productcode" >
            </div>
            <div class="form-group">
                <label>Product name</label>
                <input class="form-control" type="text" id="txt_productname" name="txt_productname" >
            </div>
            <div class="form-group">
                <label>Product description</label>
                <textarea class="form-control" type="text" id="txt_productdesc" name="txt_productdesc" ></textarea>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" type="number" id="txt_price" name="txt_price" >
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <input class="form-control" type="text" placeholder="URL..." id="txt_img" name="txt_img" >
            </div>
            <div class="form-group">
                <label>Product type</label>
                <select class="form-control" type="text" id="txt_type" name="txt_type" >
                    <option disable value="">Please select...</option>
                    @foreach($product_types as $item)
                      <option value="{{$item->id}}">{{$item->type_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-block" id="btn_save" type="submit"><i class="fa fa-plus"></i> Add</button>
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
      @foreach($products as $item)
        <div class="col">
            <div class="card border-primary shadow">
                @if($item->product_img == "")
                <img class="card-img-top" src="https://i.kym-cdn.com/entries/icons/original/000/013/564/doge.jpg">
                @else
                <img class="card-img-top" src="{{$item->product_img}}">
                @endif
                <div class="card-header bg-primary text-white">
                    <h4 class="h4">[{{$item->product_code}}] {{$item->product_name}}</h4>
                    <i class="fas fa-list-ul"></i> {{$item->type_name}}
                </div>
                <div class="card-footer">
                    <div class="btn-group shadow-sm float-right">
                        <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @php
      $count++;
    @endphp

    @if ($count % $rows == 0)
      </div><br /><div class="row row-cols-2">
    @endif

    @endforeach
</div>
@endsection