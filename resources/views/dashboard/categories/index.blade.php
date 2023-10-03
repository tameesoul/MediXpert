@extends('layouts.dashboard')
@section('content')
@section('title','categories Page')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">categories</li>
@endsection

@if (session()->has('success'))

<div class="alert alert">
    {{session('success')}}
</div>
@endif
<div class="mb-4">
    <a href="{{route('categories.create')}}" class="btn btn-larg btn-outline-primary">Create</a>
</div>
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">ParentName</th>
        <th scope="col">Created_At</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)   
        <tr>
          <td>{{$category->name}}</td>
          
          <td>{{$category->parent_id}}</td>
          <td>{{$category->created_at}}</td>
          <td>
              <a href="{{route('categories.edit',$category->id)}}" class="link-primary">edit</a>
          </td>
          <td>
              <form action="{{route('categories.destroy',$category->id)}}" method="post">
                  @csrf
                  <!-- form spoofing -->
                  @method('destroy')
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
@endsection



