<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
window.addEventListener('offline',()=>swal("Please connect to internet",'','error'));
window.addEventListener('online',()=>toastr.success("Internet Connetion Restored"));
</script>
@if($message=Session::get('success'))
<script>
swal('{{$message}}','','success');
</script>
@endif
@if($message=Session::get('error'))
<script>
swal('{{$message}}','','error');
</script>
@endif
@if($message=Session::get('info'))
<script>
swal('{{$message}}','','info');
</script>
@endif
@if ($message = Session::get('warning'))
<script>
swal('{{$message}}','','warning');
</script>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
toastr.warning("{{$error}}")
</script>
@endforeach
@endif

