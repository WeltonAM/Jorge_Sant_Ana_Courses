@if (isset($msg))
    <div style="z-index: 999" id="toastMessage" class="position-fixed bottom-0 end-0 p-3 fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header d-flex justify-content-between">
            <div>
                <img src={{ asset('img/logo.png') }} class="rounded me-2" alt="...">
                <small class="text-muted">Super Gestão</small>
            </div>

            <button id="btnClose" type="button" class="btn-close btn-sm" aria-label="Close"></button>
        </div>

        <div class="toast-body bg-{{$msgClass}} text-white">
            {{ $msg }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastMessage = document.getElementById('toastMessage');
            var btnClose = document.getElementById('btnClose');

            setTimeout(function() {
                toastMessage.classList.remove('show');
                toastMessage.classList.add('fade');
                setTimeout(function() {
                    toastMessage.remove();
                }, 1000);
            }, 5000);

            btnClose.addEventListener('click', function() {
                toastMessage.classList.remove('show');
                toastMessage.classList.add('fade');
                setTimeout(function() {
                    toastMessage.remove();
                }, 1000);
            });
        });
    </script>
@endif
