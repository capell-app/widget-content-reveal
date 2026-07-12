<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Filament;

use Capell\Admin\Contracts\Widgets\FilamentWidget;
use Capell\WidgetContentReveal\Enums\RevealBehavior;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class ContentRevealWidget implements FilamentWidget
{
    public static function getWidgetName(): string
    {
        return 'capell-app.content-reveal';
    }

    public static function make(): Block
    {
        return Block::make(self::getWidgetName())->label(__('capell-widget-content-reveal::widget.label'))->schema([TextInput::make('heading')->required()->maxLength(120), Repeater::make('cards')->minItems(1)->maxItems(12)->reorderable()->schema([TextInput::make('title')->required()->maxLength(100), Textarea::make('teaser')->required()->maxLength(400), TextInput::make('buttonLabel')->required()->maxLength(80), TextInput::make('targetInstanceId')->uuid()->required(), Select::make('behavior')->options(RevealBehavior::class)->default(RevealBehavior::Modal->value)->required()])]);
    }
}
