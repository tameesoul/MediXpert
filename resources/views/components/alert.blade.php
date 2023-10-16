@if (session()->has('success'))

<div class="alert alert">
    {{session('success')}}
</div>
@endif
@if (session()->has('info'))

<div class="alert alert">
    {{session('info')}}
</div>
@endif