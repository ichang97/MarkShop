@extends('layouts.app')

@section('content')
@if (session('result'))
<script>
    Swal.fire(
        "{{session('result.title')}}",
        "{{session('result.msg')}}",
        "{{session('result.type')}}"
    )
</script>
@endif
<div class="container">
    @if(count(session('cart')) != 0)
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class='text-center'>
            <th>Product Image</th>
            <th>Product code : Product name</th>
            <th>Quantities</th>
            <th>Price</th>
            <th>Action</th>
        </thead>
        <tbody>
        @php
            $total_price = 0; $total_qty = 0;
        @endphp
        @foreach(session('cart') as $id => $item)
            <tr>
                <td class="text-center"><img src="{{$item['img']}}" style="width: 120px"></td>
                <td class="text-center">[{{$item['product_code']}}] {{$item['product_name']}}</td>
                <td style="max-width: 60px;">
        
                    <form action="{{route('update_cart', $id)}}" method="POST" id="frm_edit{{$id}}">
                        @csrf
                        @method("PATCH")
    
                        <input class="form-control text-center" value="{{$item['quantity']}}" name="txt_qty{{$id}}" id="txt_qty{{$id}}" type="number">
                    </form>                

                </td>
                <td class="text-center">{{number_format($item['quantity'] * $item['price'],2)}}</td>
                <td>
                    <div class="text-center">
                    <button class="btn btn-danger" id="btn_del{{$id}}"><i class="fas fa-trash-alt"></i></button>
                    <form action="{{route('delete_cart', $id)}}" method="POST" id="frm_del{{$id}}">
                        @csrf
                        @method('DELETE')
                    </form>

                    <script>
                        $("#btn_del{{$id}}").on("click", function(){
                            Swal.fire({
                              title: "Are you delete ?<br/>[{{$item['product_name']}}]",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Delete',
                              cancelButtonText: `Cancel`,
                              }).then((result) => {
                                if (result.isConfirmed) {
                                  $("#frm_del{{$id}}").submit();
                                }
                              })
                        });
    
                    </script>
                    </div>
                </td>
            </tr>
            @php
                $total_price += $item['quantity'] * $item['price'];
                $total_qty += $item['quantity'];
            @endphp
        @endforeach
        </tbody>
    </table>
</div>
    <div class="h3" style="text-align: right;">
        Total Qtys = {{number_format($total_qty)}}<br />
        Total Price = {{number_format($total_price,2)}}
    </div>
    <br />
    @if(session('member_login'))
    <a href="#" class="btn btn-success btn-block"><i class="fas fa-check"></i> Confirm Order</a>
    @else
    <div class="alert alert-warning text-center">
        <b>Please login before confirm the order.</b>
    </div>
    @endif
    <br />
    @else
    <div class="alert alert-primary shadow h3 text-center">
        Cart is empty.
    </div>
    @endif
    <a href="{{route('index')}}" class="btn btn-outline-primary btn-block"><i class="fas fa-arrow-left"></i> Continue shopping.</a>
</div>
@endsection