@if(session('success'))
    <div class="notif notif-success" id="notif">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="notif notif-error" id="notif">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="notif notif-error" id="notif">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif