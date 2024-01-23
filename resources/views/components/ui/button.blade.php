@props([
    'icon'  => '',
    'title' => '',
    'type'  => 'submit'
])
<button type="submit" {!! $attributes->merge(['class' => 'btn submit']) !!}>
    @if($icon)
      <i class="{{ $icon }}"></i>
    @endif
    {{ $title }}
</button>