@extends('layouts.dashboard')

  @section('title','create Page')

  @section('breadcrumb2')
  @parent
  <li class="breadcrumb-item active">create Page</li>
  @endsection
  @section('content') 
  <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.categories._form')
</form>


  @endsection
  