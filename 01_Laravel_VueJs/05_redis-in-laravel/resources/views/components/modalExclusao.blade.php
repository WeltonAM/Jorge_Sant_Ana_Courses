<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                <button type="button" style="background-color: transparent; color: #000; border-color: transparent;" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body text-center">
                {{ $modalMessage }}
            </div>

            <div class="d-flex flex-row justify-content-center align-items-center modal-footer">
                <button class="btn btn-sm btn-secondary w-25" data-bs-dismiss="modal">Cancelar</button>
                <a id="{{ $confirmBtnId }}" class="btn btn-sm btn-danger w-25">{{ $confirmBtnText }}</a>
            </div>
        </div>
    </div>
</div>
