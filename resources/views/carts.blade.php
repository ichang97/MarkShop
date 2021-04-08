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
            $total = 0;
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
                        /*
                        $('#txt_qty{{$id}}').on("keypress", function(e){
                            if(e.which == 13){
                                ConfirmUpdate{{$id}}();
                            }
                        });

                        function handleConfirm{{$id}}(){
                            //$("#frm_edit{{$id}}").submit();
                        }

                        function ConfirmUpdate{{$id}}(){
                            Swal.fire({
                              title: "Are you delete ?<br/>[{{$item['product_name']}}]",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Delete',
                              cancelButtonText: `Cancel`,
                              }).then((result) => {
                                if (result.isConfirmed) {
                                  //
                                }
                              })
                        }
                        */
                    </script>
                    </div>
                </td>
            </tr>
            @php
                $total += $item['quantity'] * $item['price'];
            @endphp
        @endforeach
        </tbody>
    </table>
    <div class="h3" style="text-align: right;">
        Total = {{number_format($total,2)}}
    </div>
    <br />

    @else
    <div class="alert alert-primary shadow h3 text-center">
        Cart is empty.
    </div>
    @endif
    <a href="{{route('index')}}" class="btn btn-success btn-block"><i class="fas fa-arrow-left"></i> Continue shopping.</a>
</div>
@endsection