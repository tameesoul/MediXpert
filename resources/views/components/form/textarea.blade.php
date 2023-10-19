<div>
    @props([
    'name','value'=>'','label'=>'false'
    ])
@if ($label)
<label for="">{{ $label }}</label>   
@endif

  <textarea
     name="{{$name}}" 
        {{$attributes->class([
            'form-control',
            'is-invaild'=>$errors->has($name)
        ])}}
    {{ old($name, $value) }}></textarea>
    @error($name)
    <div class="alert alert-danger">
        {{$message}}
    </div> 
    @enderror
</div>