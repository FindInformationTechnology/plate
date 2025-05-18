<div class="settings-info">
    <div class="settings-sub-heading">
        <h4>Profile</h4>
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
                <h5>Basic Information</h5>
                <p>Information about user</p>
            </div>
            <div class="profile-inner">
                <div class="profile-info-pic">
                    <div class="profile-info-img">
                        <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('assets/img/profiles/avatar-15.jpg') }}" alt="Profile">
                        <div class="profile-edit-info">
                            <label for="profile_photo" style="cursor: pointer;">
                                <i class="feather-edit"></i>
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" style="display: none;">
                        </div>
                    </div>
                    <div class="profile-info-content">
                        <h6>Profile picture</h6>
                        <p>PNG, JPEG under 15 MB</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-form-group">
                            <label>Fullname <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-form-group">
                            <label>Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="whatsapp" value="{{ auth()->user()->whatsapp ?? '' }}" placeholder="Enter WhatsApp Number">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Basic Info -->

        <!-- Profile Submit -->
        <div class="profile-submit-btn">
            <button type="reset" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Profile Changes</button>
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
                <h5>Password Settings</h5>
                <p>Change your password</p>
            </div>
            <div class="profile-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>Current Password <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-form-group">
                            <label>Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Info -->

        <!-- Password Submit -->
        <div class="profile-submit-btn">
            <button type="reset" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
        <!-- /Password Submit -->
    </form>
    <!-- /Password Change Form -->
</div>