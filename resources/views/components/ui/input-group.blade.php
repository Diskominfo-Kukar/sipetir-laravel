@props([
    'disabled'   => false,
    'id'         => '',
    'label'      => '',
    'typeGroup' => 'prepend',
    'icon'       => '<i class="fa fa-circle"></i>'
])

@php
    $classInput = 'form-control';
    $classInputGroup = 'input-group';
    $classInputIcon = 'input-group-text';
    if($errors->has($attributes->get('name'))){
        $classInput .= ' is-invalid';
        $classInputGroup .= ' is-invalid';
        $classInputIcon .= ' bg-strong-bliss text-white';

    }
@endphp
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="{{ $classInputGroup }}">
        @if($typeGroup == 'prepend')
            <div class="{{ $classInputIcon }}">
                <span class="">
                    {!! $icon !!}
                </span>
            </div>
        @endif
        <input {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" {!! $attributes->merge(['class' => $classInput]) !!}/>
        @if($typeGroup == 'append')
            <div class="{{ $classInputIcon }}">
                <span class="">
                    {{ $icon }}
                </span>
            </div>
        @endif
    </div>
    @if($errors->has($attributes->get('name')))
        <div class="invalid-feedback">{{ucwords($errors->first($attributes->get('name')))}}</div>
    @endif
</div>