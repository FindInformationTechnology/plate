<div class="settings-info">
    <div class="settings-sub-heading">
        <h4>{{ __('message.Profile') }}</h4>
    </div>

    @if(session('profile_success'))
    <div class="alert alert-success">
        {{ session('profile_success') }}
    </div>
    @endif

    @if(session('password_success'))
    <div class="alert alert-success">
        {{ session('password_success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Profile Information Form -->
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Basic Info -->
        <div class="profile-info-grid">
            <div class="profile-info-header">
                <h5>{{ __('message.Basic_Information') }}</h5>
                <p>{{ __('message.Information_about_user') }}</p>
            </div>
            <div class="profile-inner">
                <div class="profile-info-pic">
                    <div class="profile-info-img">
                        <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('assets/img/profiles/avatar-15.jpg') }}"
                            alt="Profile">
                        <div class="profile-edit-info">
                            <label for="profile_photo" style="cursor: pointer;">
                                <i class="feather-edit"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" style="display: none;">
                        </div>
                    </div>
                    <div class="profile-info-content">
                        <h6>{{ __('message.Profile_picture') }}</h6>
                        <p>{{ __('message.PNG_JPEG_under_15_MB') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-form-group">
                            <label>{{ __('message.Fullname') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>{{ __('message.Email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>{{ __('message.Phone_Number') }} <span class="text-danger">*</span></label>
                            <input  type="text" name="phone" class="form-control " style="direction: ltr;"
                                value="{{ auth()->user()->phone_number ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-form-group">
                            <label>{{ __('message.Whatsapp') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="whatsapp" style="direction: ltr;"
                                value="{{ auth()->user()->whatsapp_number ?? '' }}"
                                placeholder="{{ __('message.Enter_WhatsApp_Number') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Basic Info -->

        <!-- Profile Submit -->
        <div class="profile-submit-btn">
            <button type="reset" class="btn btn-secondary">{{ __('message.Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('message.Save_Profile_Changes') }}</button>
        </div>
        <!-- /Profile Submit -->
    </form>
    <!-- /Profile Information Form -->

    <!-- Password Change Form -->
    <form action="{{ route('user.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Password Info -->
        <div class="profile-info-grid mt-4">
            <div class="profile-info-header">
                <h5>{{ __('message.Password_Settings') }}</h5>
                <p>{{ __('message.Change_your_password') }}</p>
            </div>
            <div class="profile-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>{{ __('message.Current_Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>{{ __('message.New_Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>{{ __('message.Confirm_New_Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Info -->

        <!-- Password Submit -->
        <div class="profile-submit-btn">
            <button type="reset" class="btn btn-secondary">{{ __('message.Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('message.Update_Password') }}</button>
        </div>
        <!-- /Password Submit -->
    </form>
    <!-- /Password Change Form -->
</div>