<script>
    @if(Session::has('success'))
        toastr.success("{{ session('success') }}");
    @elseif(Session::has('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>