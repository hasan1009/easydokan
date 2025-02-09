@if (!empty(session('succsess')))
    <div class="alert alert-success" role="alert">
        {{ session('succsess') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
