
<ol class="p-0 mb-0 breadcrumb">
  <li class="breadcrumb-item">
    <a>
        <i aria-hidden="true" class="fa fa-home"></i>
    </a>
  </li>
  @foreach($crumbs as $t => $val_link)
      @if($val_link == "")
        <li class="breadcrumb-item active" aria-current="page">{{$t}}</li>
      @else
      
        <li class="breadcrumb-item">
            <a href="{{$val_link}}"> {!! $t !!}</a>
        </li>
      @endif
    @endforeach
</ol>

