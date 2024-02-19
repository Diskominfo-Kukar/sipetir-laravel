@props([
    'id'       => 'my-modal',
    'title'    => 'Modal',
    'form'     => true, //bool
    'action'   => null, //url
    'formData' => false, //enctype
    'button'   => null, // custom button
    'fallback' => false //reopen modal
])



<!-- Modal -->
<div class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div  {!! $attributes->merge(['class' => 'modal-dialog']) !!}>
    <div class="modal-content">
      @if($form)
        <form method="POST" id="form" action="{{ $action }}" @if($formData) enctype="multipart/form-data" @endif>
          @csrf
          @if($fallback)
            <input type="hidden" name="modal_id" value="{{ $id }}">
            <input type="hidden" name="action_url" id="action_url" value="">
            <input type="hidden" name="load_url" id="load_url" value="">
          @endif
      @endif
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{!! $title !!}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

        </button>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        @if($button)
          {!! $button !!}
        @else
          <button type="submit" class="btn btn-primary submit">Simpan</button>
        @endif
      </div>
      @if($form)
        </form>
      @endif
    </div>
  </div>
</div>
