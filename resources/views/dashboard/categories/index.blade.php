@extends('layouts.dashboard')
@section('content')
@section('title','categories Page')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">categories</li>
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
        <th scope="col">ParentName</th>
        <th scope="col">description</th>
        <th scope="col">status</th>
        <th scope="col">image</th>
        <th scope="col">Created_At</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)   
        <tr>
          <td>{{$category->name}}</td>
          <td>{{$category->parents_name}}</td>
          <td>{{$category->description}}</td>
          <td>{{$category->status}}</td>
          <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="80"></td>
          <td>{{$category->created_at}}</td>
          <td>
              <a href="{{route('dashboard.categories.edit',$category->id)}}" class="link-primary">edit</a>
          </td>
          <td>
              <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post">
                  @csrf
                  <!-- form spoofing -->
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">delete</button>
              </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">NO Categories Yet.</td>
        </tr>
        @endforelse
    </tbody>
   
  </table>
  {{$categories->withQueryString()->links()}}
@endsection



