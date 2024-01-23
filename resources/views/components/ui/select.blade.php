@props([
    'disabled' => false,
    'id'       => '',
    'label'    => '',
    'data'     => [],
    'key'      => null,
    'value'    => null,
])

@php
    $classInput = 'form-control';
    if($errors->has($attributes->get('name'))){
        $classInput .= ' is-invalid';
    }
@endphp

<div class="form-group">
  <label for="{{ $id }}">{{ $label }}</label>
  <select {!! $attributes->merge(['class' => $classInput]) !!} id="{{ $id }}">
      <option></option>
      @foreach($data as $item)
        <option value="{{ $key ? $item[$key] : $item->id }}">{{ $value ? $item[$value] : $item->name }}</option>
      @endforeach
  </select>
  @if($errors->has($attributes->get('name')))
      <div class="invalid-feedback">{{ucwords($errors->first($attributes->get('name')))}}</div>
  @endif
</div>