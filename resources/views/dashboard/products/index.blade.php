@extends('layouts.dashboard')

  @section('title','products Page')

  @section('breadcrumb2')
  @parent
  <li class="breadcrumb-item active">products Page</li>
  @endsection

  
  @section('content')
  <div class="mb-4">
    <a href="{{route('dashboard.products.create')}}" class="btn btn-larg btn-outline-primary">Create</a>
</div>
<x-alert type="success"/>
<x-alert type="danger"/>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
  <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
  <select name="status" class="form-control mx-2">
      <option value="">All</option>
      <option value="active" @selected(request('status') == 'active')>Active</option>
      <option value="archived" @selected(request('status') == 'archived')>Archived</option>
  </select>
  <button class="btn btn-dark mx-2">Filter</button>
</form>
  <table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">image</th>
            <th scope="col">Name</th>
            <th scope="col">category name</th>
            <th scope="col">store name</th>
            <th scope="col">price</th>
            <th scope="col">status</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
    </thead>
    @forelse ($products as $product)
    <tbody>
        <tr>
          <td><img src="{{asset('storage/'.$product->image)}}" alt="" height="80"></td>
          <td>{{$product->name}}</td>
          <td>{{$product->category->name}}</td>
          <td>{{$product->store->name}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->status}}</td>
          <td>
                <a href="{{route('dashboard.products.edit',$product->id)}}" class="btn btn-larg btn-outline-primary">edit</a>
          </td>
          <td>
            <form action="{{route('dashboard.products.destroy',$product->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit"  class="btn btn-larg btn-outline-danger" >Delete</button>
            </form>
          </td>
        </tr>  
        @empty
        <tr>
            <td>no products yet</td>  
         </tr>
      </tbody>
    
    @endforelse
    
  </table>

  {{$products->withQueryString()->links()}}
  @endsection