<div class="container mt-3">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <div class="row align-items-center">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center pb-2 pb-md-0">
                    <i class="bx bx-phone-call fs-1 me-3"></i>
                    <div>
                        <h6 class="alert-heading mb-1">{{ __('message.Complete_Your_Profile') }}</h6>
                        <p class="mb-0">{{ __('message.Please_add_contact_details') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-md-end">
                <a href="{{ route('user.profile') }}" class="btn btn-warning btn-sm text-nowrap w-100 w-md-auto">
                    <i class="bx bx-edit me-1"></i>
                    {{ __('message.Update_Profile') }}
                </a>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>