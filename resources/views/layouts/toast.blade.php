<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">Notifikasi</strong>
        <small>baru saja</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        @foreach ($errors->all() as $message)
            <p class="text-danger">{{ $message }}</p>
        @endforeach
        <p class="text-success">{{ session()->get('notify') }}</p>
      </div>
    </div>
</div>

@if ($errors->any() || session()->has('notify'))
      <script>
          var myAlert =document.getElementById('liveToast');
          var bsAlert = new bootstrap.Toast(myAlert);
          bsAlert.show();
      </script>
@endif