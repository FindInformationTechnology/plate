<div class="tns tns-default" style="direction: ltr">
    <!--begin::Slider-->
    <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
        data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false"
        data-tns-items="3" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev1"
        data-tns-next-button="#kt_team_slider_next1">

        @foreach ($variant->product->stories as $story)
            <!--begin::Item-->
            <div class="text-center px-5 py-5">
                <img src="{{ asset('assets/dashboard-assets/media/stock/600x400/img-1.jpg') }}" class="card-rounded mw-100"
                    alt="" />
            </div>
            <!--end::Item-->
        @endforeach
        ...
    </div>
    <!--end::Slider-->

    <!--begin::Slider button-->
    <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
        <span class="svg-icon fs-3x">
            ...
        </span>
    </button>
    <!--end::Slider button-->

    <!--begin::Slider button-->
    <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
        <span class="svg-icon fs-3x">
            ...
        </span>
    </button>
    <!--end::Slider button-->
</div>
