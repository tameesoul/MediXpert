@extends('layouts.dashboard')
@section('content')
@section('title',' create categories Page')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"> create categories</li>
@endsection

<form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.categories._form');
</form>

@endsection