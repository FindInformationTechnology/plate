
<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ __('message.Security_Settings') }}</h4>
        <form>
            <div class="form-group">
                <label>{{ __('message.New_Password') }}</label>
                <input type="password" class="form-control">
            </div>
            <div class="form-group">
                <label>{{ __('message.Confirm_Password') }}</label>
                <input type="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('message.Update_Password') }}</button>
        </form>
    </div>
</div>