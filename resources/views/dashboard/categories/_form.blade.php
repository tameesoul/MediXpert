@if($errors->any())
    <div class="alert alert-danger">
        <h3>error!</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    <x-form.input label="Category Name"  role="input" name="name" :value="$category->name" />
</div>
<div class="form-group">
    <label for="">category parent</label>
    <select name="parent_id" class="form-control">
        <option value="">primary category</option>
        @foreach ($parents as $parent)  
        <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>
 <div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$category->description" />
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if($category->image)
    <img src="{{asset('storage/'.$category->image)}}" alt="" height="80">
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-larg btn-outline-primary">Save Category</button>
</div>