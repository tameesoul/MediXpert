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
    <x-form.input label='category name' class="form-control-lg " role="input" name="name" :value="$category->name" />
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

    <x-form.textarea label='description'  name="description" :value="$category->description"/> 
    
</div>

<div class="form-group">
   
    <x-form.input label='image' type="file" name="image"/>
    @if ($category->image)
    <img src="{{asset('storage/'.$category->image)}}" alt="" height="80">
    @endif
</div>
<div class="form-group">
    <label>Status</label>
    <div>
        <x-form.radio name="status" :checked="$category->status" :options="['active' => 'active', 'archived' => 'archived']"/>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-larg btn-outline-primary">{{$button_label??'save'}}</button>
</div>
