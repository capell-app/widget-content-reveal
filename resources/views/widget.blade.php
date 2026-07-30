@php /** @var \Capell\WidgetContentReveal\Data\ContentRevealRenderData $renderData */ $pageData = $publicPageRenderData ?? null; @endphp
<section class="capell-content-reveal">
    <h2>{{ $renderData->heading }}</h2>
    <div class="capell-content-reveal__grid">
        @foreach ($renderData->cards as $card)
            @php $locator = $pageData?->widgetInteractionLocator($card->targetInstanceId); @endphp
            <article>
                <h3>{{ $card->title }}</h3>
                <p>{{ $card->teaser }}</p>
                @if ($locator)
                    <a
                        href="{{ $locator }}"
                        data-capell-interaction
                        data-capell-interaction-event="click"
                        data-capell-interaction-behavior="{{ $card->behavior }}"
                        data-capell-interaction-target-url="{{ $locator }}"
                        data-capell-interaction-target-type="widget"
                        data-capell-interaction-close-on-backdrop="true"
                        data-capell-interaction-close-label="{{ __('capell-widget-content-reveal::widget.close') }}"
                        data-capell-interaction-loading-label="{{ __('capell-widget-content-reveal::widget.loading') }}"
                        data-capell-interaction-ready-label="{{ __('capell-widget-content-reveal::widget.ready') }}"
                        data-capell-interaction-error-label="{{ __('capell-widget-content-reveal::widget.error') }}"
                        data-capell-interaction-asset-error-label="{{ __('capell-widget-content-reveal::widget.asset_error') }}"
                        data-capell-interaction-retry-label="{{ __('capell-widget-content-reveal::widget.retry') }}"
                        data-capell-interaction-fallback-label="{{ __('capell-widget-content-reveal::widget.fallback') }}"
                        >{{ $card->buttonLabel }}</a
                    >
                @else
                    <span>{{ $card->buttonLabel }}</span>
                @endif
            </article>
        @endforeach
    </div>
    <span
        class="capell-content-reveal__status"
        role="status"
        aria-live="polite"
        data-capell-interaction-status
    ></span>
</section>
