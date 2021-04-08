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
                      <h4 class="h4">[{{$item->product_code}}] {{$item->product_name}}<div class="float-right">{{number_format($item->price,2)}}</div></h4>
                      <i class="fas fa-list-ul"></i> {{$item->type_name}}
                  </div>
                  <div class="card-footer">
                      <a href="{{route('add_to_cart', $item->product_id)}}" class="btn btn-success btn-block"><i class="fas fa-cart-plus"></i> Add to cart</a>
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