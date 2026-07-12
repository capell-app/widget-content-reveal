<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Health;

use Capell\LayoutBuilder\Health\AbstractWidgetExtensionHealthCheck;
use Capell\WidgetContentReveal\Filament\ContentRevealWidget;

final class WidgetContentRevealHealthCheck extends AbstractWidgetExtensionHealthCheck
{
    public static function compatibleCapellApiVersion(): string
    {
        return '^0.0';
    }

    protected static function definitionKey(): string
    {
        return 'capell-app.content-reveal';
    }

    protected static function filamentWidget(): string
    {
        return ContentRevealWidget::class;
    }

    protected static function fallbackView(): string
    {
        return 'capell-widget-content-reveal::widget';
    }

    protected static function resourceGroups(): array
    {
        return ['capell-app.widget-content-reveal'];
    }
}
