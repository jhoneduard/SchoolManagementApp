@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="fas fa-info-circle"></i>{{ $message}}</strong>
  <a type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </a>
</div>
@endif
  
@if ($message = Session::get('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><i class="fas fa-exclamation-circle"></i> {{ $message}}</strong>
    <a type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true"><i class="fas fa-times"></i></span>
    </a>
  </div>
@endif
   
@if ($message = Session::get('warning'))

@endif
   
@if ($message = Session::get('info'))

@endif
  
@if ($errors->any())

@endif