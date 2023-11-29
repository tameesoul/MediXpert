@extends('layouts.dashboard')

  @section('title','categories Page')

  @section('breadcrumb2')
  @parent
  <li class="breadcrumb-item active">trashes Page</li>
  @endsection

  
  @section('content')
  <div class="mb-4">
    <a href="{{route('dashboard.categories.index')}}" class="btn btn-larg btn-outline-primary">Back</a>
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
            <th scope="col">ParentName</th>
            <th scope="col">description</th>
            <th scope="col">status</th>
            <th scope="col">Created_At</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
    </thead>
    @forelse ($categories as $category)
    <tbody>
        <tr>
          <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="80"></td>
          <td>{{$category->name}}</td>
          <td>{{$category->parent_name}}</td>
          <td>{{$category->description}}</td>
          <td>{{$category->status}}</td>
          <td>{{$category->created_at}}</td>
          <td>
            <form action="{{route('dashboard.categories.restore',$category->id)}}" method="post">
                @method('PUT')
                @csrf
                <button type="submit"  class="btn btn-larg btn-outline-primary">Restore</button>
            </form>
          </td>
          <td>
            <form action="{{route('dashboard.categories.force-delete',$category->id)}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit"  class="btn btn-larg btn-outline-danger"> forece Delete</button>
            </form>
          </td>
        </tr>  
        @empty
        <tr>
            <td>no categories yet</td>  
         </tr>
      </tbody>
    
    @endforelse
    
  </table>

  {{$categories->withQueryString()->links()}}
  @endsection