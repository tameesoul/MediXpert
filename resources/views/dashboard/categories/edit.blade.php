@extends('layouts.dashboard')
@section('content')
@section('title',' Edit categories Page')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"> edit categories</li>
@endsection

<form action="{{route('dashboard.categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
 @include('dashboard.categories._form')
</form>

@endsection 