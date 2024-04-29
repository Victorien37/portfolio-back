<div id="message">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif
</div>


@push('footer_js')
    <script>
        setTimeout(() => {
            document.getElementById('message').innerHTML = '';
        }, 10000);
    </script>
@endpush
