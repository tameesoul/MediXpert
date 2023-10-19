<div>
    @props([
    'type'=>'text','name','value'=>'','label'=>'false'
    ])
@if ($label)
<label for="">{{ $label }}</label>   
@endif

    <input type="{{$type}}"
     name="{{$name}}" 
        {{$attributes->class([
            'form-control',
            'is-invaild'=>$errors->has($name)
        ])}}
    value="{{ old($name, $value) }}">
    @error($name)
    <div class="alert alert-danger">
        {{$message}}
    </div> 
    @enderror
</div>