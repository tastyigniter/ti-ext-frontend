<div
    id="{{ $sliderSelectorId }}"
    class="carousel slide"
    data-ride="carousel"
>
    @if ($showSliderIndicators)
        <ol class="carousel-indicators">
            @foreach ($__SELF__->slides() as $slide)
                <li
                    class="{{ $loop->first ? 'active' : '' }}"
                    data-target="#{{ $sliderSelectorId }}"
                    data-slide-to="{{ $sliderSelectorId }}"
                ></li>
            @endforeach
        </ol>
    @endif

    <div class="carousel-inner">
        @foreach ($__SELF__->slides() as $slide)
            <div
                class="carousel-item {{ $loop->first ? 'active' : '' }}"
                style="max-height:{{ $sliderHeight }};"
            >
                <img
                    src="{{ $slide->getThumb() }}"
                    class="d-block w-100"
                    alt="{{ $slide->getCustomProperty('title') }}"
                />

                @if ($showSliderCaptions && strlen($slide->getCustomProperty('description')))
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $slide->getCustomProperty('title') }}</h5>
                        <p>{{ $slide->getCustomProperty('description') }}</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if ($showSliderControls && count($__SELF__->slides()) > 1)
        <a
            class="carousel-control-prev"
            href="#{{ $sliderSelectorId }}"
            role="button"
            data-slide="prev"
        ><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
        <a
            class="carousel-control-next"
            href="#{{ $sliderSelectorId }}"
            role="button"
            data-slide="next"
        ><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
    @endif
</div>
