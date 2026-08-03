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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notif = document.getElementById('notif');

        if (notif) {
            setTimeout(function () {
                notif.style.transition = 'opacity 0.5s ease';
                notif.style.opacity = '0';

                setTimeout(function () {
                    notif.remove();
                }, 500);
            }, 3000);
        }
    });
</script>