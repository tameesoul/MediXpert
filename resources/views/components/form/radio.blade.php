@props([
    'name','options','checked'=>false
])
@foreach ($options as $value=>$text)
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="{{ $name }}" id="status_{{ $value }}" value="{{ $value }}" 
            @checked(old($name, $checked) == $value)
            {{ $attributes->class([
                'form-check-input',
                'is-invalid' => $errors->has($name)
            ]) }}
        >
        <label class="form-check-label" for="status_{{ $value }}">
            {{ $text }}
        </label>
    </div>    
@endforeach