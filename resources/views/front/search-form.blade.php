<div class="mt-5 col-md-12 rounded-md search">
    <form class="d-flex flex-wrap gap-2 search-bar" action="{{ route('plates.search') }}" method="GET">
        <!-- All Options -->
        <div class="options d-flex flex-wrap gap-2 w-100">
            <!-- Main Options -->
            <select class="form-control search-option" id="emirate_id" name="emirate_id">
                <option value="">{{ __('message.Select_Emirate') }}</option>
                @foreach(\App\Models\Emirate::all() as $emirate)
                <option value="{{ $emirate->id }}" {{ request('emirate_id') == $emirate->id ? 'selected' : '' }}>
                    {{ $emirate->name }}
                </option>
                @endforeach
            </select>

            <select class="form-control search-option" id="code_id" name="code_id">
                <option value="">{{ __('message.Select_Code') }}</option>
                <!-- Codes will be populated here dynamically -->
            </select>

            <select class="form-control search-option" name="length">
                <option value="">{{ __('message.All_Digit') }}</option>
                <option value="1" {{ request('length') == '1' ? 'selected' : '' }}>1 {{ __('message.Digits') }}</option>
                <option value="2" {{ request('length') == '2' ? 'selected' : '' }}>2 {{ __('message.Digits') }}</option>
                <option value="3" {{ request('length') == '3' ? 'selected' : '' }}>3 {{ __('message.Digits') }}</option>
                <option value="4" {{ request('length') == '4' ? 'selected' : '' }}>4 {{ __('message.Digits') }}</option>
                <option value="5" {{ request('length') == '5' ? 'selected' : '' }}>5 {{ __('message.Digits') }}</option>
            </select>

            <!-- Format Dropdown -->
            <select class="form-control search-option extra d-none" name="format">
                <option value="">{{ __('message.Select_Format') }}</option>
                
                <!-- Repeat Patterns -->
                <optgroup label="{{ __('message.Repeat_Patterns') }}">
                    <option value="repeat_2" {{ request('format') == 'repeat_2' ? 'selected' : '' }}>
                        {{ __('message.Contains_Digit_Repeated_2_Times') }}
                    </option>
                    <option value="repeat_3" {{ request('format') == 'repeat_3' ? 'selected' : '' }}>
                        {{ __('message.Contains_Digit_Repeated_3_Times') }}
                    </option>
                    <option value="repeat_4" {{ request('format') == 'repeat_4' ? 'selected' : '' }}>
                        {{ __('message.Contains_Digit_Repeated_4_Times') }}
                    </option>
                </optgroup>

                <!-- 3 Digit Patterns -->
                <optgroup label="{{ __('message.3_Digit_Patterns') }}">
                    <option value="x_y_z_3_Digits" {{ request('format') == 'x_y_z_3_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_y_z_3_Digits') }}
                    </option>
                    <option value="x_y_y_3_Digits" {{ request('format') == 'x_y_y_3_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_y_y_3_Digits') }}
                    </option>
                    <option value="x_x_y_3_Digits" {{ request('format') == 'x_x_y_3_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_x_y_3_Digits') }}
                    </option>
                    <option value="x_x_x_3_Digits" {{ request('format') == 'x_x_x_3_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_x_x_3_Digits') }}
                    </option>
                </optgroup>

                <!-- 4 Digit Patterns -->
                <optgroup label="{{ __('message.4_Digit_Patterns') }}">
                    <option value="x_any_any_x" {{ request('format') == 'x_any_any_x' ? 'selected' : '' }}>
                        {{ __('message.x??x_4_Digits') }}
                    </option>
                    <option value="x_y_y_x_4_Digits" {{ request('format') == 'x_y_y_x_4_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_y_y_x_4_Digits') }}
                    </option>
                    <option value="?_x_x_?_4_Digits" {{ request('format') == '?_x_x_?_4_Digits' ? 'selected' : '' }}>
                        {{ __('message.?_x_x_?_4_Digits') }}
                    </option>
                    <option value="x_y_y_y_4_Digits" {{ request('format') == 'x_y_y_y_4_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_y_y_y_4_Digits') }}
                    </option>
                    <option value="x_x_x_y_4_Digits" {{ request('format') == 'x_x_x_y_4_Digits' ? 'selected' : '' }}>
                        {{ __('message.x_x_x_y_4_Digits') }}
                    </option>
                </optgroup>

                <!-- 5 Digit Patterns -->
                <optgroup label="{{ __('message.5_Digit_Patterns') }}">
                    <option value="x_any_any_any_x" {{ request('format') == 'x_any_any_any_x' ? 'selected' : '' }}>
                        {{ __('message.X???X_5_Digits') }}
                    </option>
                    <option value="x_y_z_y_x" {{ request('format') == 'x_y_z_y_x' ? 'selected' : '' }}>
                        {{ __('message.XYZYX_5_Digits') }}
                    </option>
                    <option value="x_x_z_x_x" {{ request('format') == 'x_x_z_x_x' ? 'selected' : '' }}>
                        {{ __('message.XXZXX_5_Digits') }}
                    </option>
                    <option value="any_x_x_x_any" {{ request('format') == 'any_x_x_x_any' ? 'selected' : '' }}>
                        {{ __('message.?XXX?_5_Digits') }}
                    </option>
                    <option value="any_any_x_x_x" {{ request('format') == 'any_any_x_x_x' ? 'selected' : '' }}>
                        {{ __('message.??xxx_5_Digits') }}
                    </option>
                    <option value="xxx??_5_Digits" {{ request('format') == 'xxx??_5_Digits' ? 'selected' : '' }}>
                        {{ __('message.xxx??_5_Digits') }}
                    </option>
                    <option value="xxxxx_5_Digits" {{ request('format') == 'xxxxx_5_Digits' ? 'selected' : '' }}>
                        {{ __('message.xxxxx_5_Digits') }}
                    </option>
                </optgroup>
            </select>

            <!-- More Options -->
            <input type="number" class="form-control search-option extra d-none" name="max_price"
                placeholder="{{ __('message.Maximum_Price') }}" value="{{ request('max_price') }}">
            <input type="number" class="form-control search-option extra d-none" name="min_price"
                placeholder="{{ __('message.Minimum_Price') }}" value="{{ request('min_price') }}">
            <input type="number" class="form-control search-option extra d-none" name="start_with"
                placeholder="{{ __('message.Start_With') }}: ex:123" value="{{ request('start_with') }}">
            <input type="number" class="form-control search-option extra d-none" name="end_with"
                placeholder="{{ __('message.End_With') }}: ex:000" value="{{ request('end_with') }}">

            <!-- Search Button -->
            <button class="search-btn d-flex align-items-center gap-2" type="submit">
                <i class="bx bx-search"></i>
                <span>{{ __('message.Search') }}</span>
            </button>
        </div>
    </form>
    <p class="toggle-options">+ {{ __('message.more_options') }}</p>
</div>