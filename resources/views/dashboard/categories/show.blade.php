@extends('layouts.dashboard')
@section('title','  categories Page')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">  category page</li>
<li class="breadcrumb-item active">  {{$category->name}}</li>
@endsection

@section('content')
<table class="table table-dark">
    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
      <x-form.input  label="search" name='name' aria-placeholder="categoryname" :value="request('name')"/>
      <select name="status" class="form-control">
        <option value="ALL">All</option>
        <option value="active"@selected(request('status')=='active')>active</option>
        <option value="archived"@selected(request('archived')=='archived')>archived</option>
      </select>
      <button class="btn btn-dark">filter</button>
    </form>
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">store_Name</th>
          <th scope="col">description</th>
          <th scope="col">status</th>
          <th scope="col">image</th>
        </tr>
      </thead>
      <tbody>
          @forelse ($category->products as $product)   
          <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->stores->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->status}}</td>
            <td><img src="{{asset('storage/'.$product->image)}}" alt="" height="80"></td>
            <td>{{$product->created_at}}</td>
          </tr>
          @empty
          <tr>
            <td colspan="7">No products Yet.</td>
          </tr>
          @endforelse
      </tbody>
     
    </table>
@endsection