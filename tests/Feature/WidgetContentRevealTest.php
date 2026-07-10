<?php

declare(strict_types=1);
use Capell\LayoutBuilder\Support\WidgetExtensions\WidgetExtensionRegistry;
use Capell\WidgetContentReveal\Data\ContentRevealInputData;
use Capell\WidgetContentReveal\Health\WidgetContentRevealHealthCheck;
use Capell\WidgetContentReveal\Providers\WidgetContentRevealServiceProvider;
use Illuminate\Validation\ValidationException;

beforeEach(function (): void {
    $this->app->register(WidgetContentRevealServiceProvider::class);
});
it('registers all supported reveal behaviors', function (): void {
    expect(resolve(WidgetExtensionRegistry::class)->definition('capell-app.content-reveal')?->capabilities->supportedInteractionBehaviors)->toHaveCount(4)->and(WidgetContentRevealHealthCheck::passed())->toBeTrue();
});
it('requires stable target identities and bounded cards', function (): void {
    expect(fn () => ContentRevealInputData::validateAndCreate(['heading' => 'More', 'cards' => [['title' => 'Card', 'teaser' => 'Text', 'buttonLabel' => 'Open', 'targetInstanceId' => 'unsafe']]]))->toThrow(ValidationException::class);
});
