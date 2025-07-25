@props(['type' => 'info', 'message', 'title' => null, 'dismissible' => true])

<div class="toast-notification toast-{{ $type }} {{ $dismissible ? 'toast-dismissible' : '' }}" 
     role="alert" 
     aria-live="assertive" 
     aria-atomic="true">
    <div class="toast-header">
        @if($type === 'success')
            <i class="bx bx-check-circle text-success me-2"></i>
        @elseif($type === 'error' || $type === 'danger')
            <i class="bx bx-error-circle text-danger me-2"></i>
        @elseif($type === 'warning')
            <i class="bx bx-error text-warning me-2"></i>
        @else
            <i class="bx bx-info-circle text-info me-2"></i>
        @endif
        
        @if($title)
            <strong class="me-auto">{{ $title }}</strong>
        @else
            <strong class="me-auto">
                @if($type === 'success')
                    {{ __('message.Success') }}
                @elseif($type === 'error' || $type === 'danger')
                    {{ __('message.Error') }}
                @elseif($type === 'warning')
                    {{ __('message.Warning') }}
                @else
                    {{ __('message.Info') }}
                @endif
            </strong>
        @endif
        
        <small class="text-muted">{{ __('message.Just_Now') }}</small>
        
        @if($dismissible)
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        @endif
    </div>
    <div class="toast-body">
        {{ $message }}
    </div>
</div>

<style>
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    min-width: 300px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: none;
}

.toast-success {
    border-left: 4px solid #28a745;
}

.toast-error,
.toast-danger {
    border-left: 4px solid #dc3545;
}

.toast-warning {
    border-left: 4px solid #ffc107;
}

.toast-info {
    border-left: 4px solid #17a2b8;
}

.toast-header {
    background: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

@media (max-width: 768px) {
    .toast-notification {
        right: 10px;
        left: 10px;
        min-width: auto;
    }
}
</style> 