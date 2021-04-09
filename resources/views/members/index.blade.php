@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-primary shadow">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> My Profile
        </div>
        <div class="card-body">
            <table class="table table-hover">
                @foreach($member as $item)
                <tr>
                    <th>Full Name :</th>
                    <td>{{$item->firstname}} {{$item->lastname}}</td>
                </tr>
                <tr>
                    <th>Username :</th>
                    <td>{{$item->username}}</td>
                </tr>
                <tr>
                    <th>Member created at :</th>
                    <td>{{$item->created_at}}</td>
                </tr>
                <tr>
                    <th>Date of birth :</th>
                    <td>{{$item->dob}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection