
<script src="{{ asset('js/bootstrap.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/utility.js') }}" defer></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
        function readURL(input , jquery_id) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#'+jquery_id)
        .attr('src', e.target.result);
    };
        reader.readAsDataURL(input.files[0]);
        $('#'+jquery_id).show();
    }
    }
</script>

@yield('scripts')
