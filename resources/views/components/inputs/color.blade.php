@php
    if(!isset($name)){
        $name = (string) str($label)->snake();
    }
    $old = old($name)
@endphp


<div class="form-group">
    <label for="{{ str($label)->slug() }}">{{ $label }}</label>
    <input type="text"
           style="width: 90px"
           id="{{ str($label)->slug() }}"
           name="{{ $name }}"
           @if(isset($value)||isset($old))
           value="{{ isset($value) ? old($name, $value) : old($name) }}"
           @endif
           class="my-colorpicker">
    @error($name)
    {{ $message }}
    @enderror()
</div>
