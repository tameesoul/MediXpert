@extends('layouts.dashboard')
@section('content')
@section('title','products Page')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">products</li>
@endsection

<x-alert  type="success"/>
<x-alert  type="info"/>
<div class="mb-4">
    <a href="{{route('dashboard.categories.create')}}" class="btn btn-larg btn-outline-primary">Create</a>
</div>
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
        <th scope="col">category_Name</th>
        <th scope="col">store_Name</th>
        <th scope="col">description</th>
        <th scope="col">status</th>
        <th scope="col">image</th>
        <th scope="col">Created_At</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)   
        <tr>
          <td>{{$product->name}}</td>
          <td>{{$product->category_id}}</td>
          <td>{{$product->store_id}}</td>
          <td>{{$product->description}}</td>
          <td>{{$product->status}}</td>
          <td><img src="{{asset('storage/'.$product->image)}}" alt="" height="80"></td>
          <td>{{$product->created_at}}</td>
          <td>
              <a href="{{route('dashboard.products.edit',$product->id)}}" class="link-primary">edit</a>
          </td>
          <td>
              <form action="{{route('dashboard.categories.destroy',$product->id)}}" method="post">
                  @csrf
                  <!-- form spoofing -->
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">delete</button>
              </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">NO products Yet.</td>
        </tr>
        @endforelse
    </tbody>
   
  </table>
  {{$products->withQueryString()->links()}}
@endsection
