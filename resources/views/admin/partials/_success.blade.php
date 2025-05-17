<script>
    @if(Session::has('success'))
        toastr.success("{{ session('success') }}");


        

    @endif
</script>