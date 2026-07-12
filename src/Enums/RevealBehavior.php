<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Enums;

use Filament\Support\Contracts\HasLabel;

enum RevealBehavior: string implements HasLabel
{
    case Modal = 'modal';
    case SlideOver = 'slide_over';
    case Inline = 'inline_reveal';
    case Replace = 'replace_region';

    public function getLabel(): string
    {
        return match ($this) {
            self::Modal => __('capell-widget-content-reveal::widget.modal'),self::SlideOver => __('capell-widget-content-reveal::widget.slide_over'),self::Inline => __('capell-widget-content-reveal::widget.inline'),self::Replace => __('capell-widget-content-reveal::widget.replace')
        };
    }
}
