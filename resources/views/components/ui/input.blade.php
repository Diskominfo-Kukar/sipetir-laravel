@props([
    'disabled' => false,
    'id' => '',
    'label' => '',
    'name' => '',
    'type' => 'text',
])

@php
    $classInput = 'form-control';
    if ($errors->has($attributes->get('name'))) {
        $classInput .= ' is-invalid';
    }
@endphp

<div class="form-group mb-2">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input
    {{ $disabled ? 'disabled' : '' }}
    type={{ $type }}
    name={{ $name }}
    id="{{ $id }}"
    {!! $attributes->merge(['class' => $classInput]) !!}
    />
    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">{{ ucwords($errors->first($attributes->get('name'))) }}</div>
    @endif
</div>
