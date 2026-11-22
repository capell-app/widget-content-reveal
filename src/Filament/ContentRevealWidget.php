<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Filament;

use Capell\Admin\Actions\Widgets\NormalizeContentWidgetStateAction;
use Capell\Admin\Contracts\Widgets\FilamentWidget;
use Capell\Admin\Filament\Components\Forms\Editor\ContentBuilder;
use Capell\WidgetContentReveal\Actions\BuildRevealTargetOptionsAction;
use Capell\WidgetContentReveal\Enums\RevealBehavior;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Get;
use Override;

final class ContentRevealWidget implements FilamentWidget
{
    #[Override]
    public static function getWidgetName(): string
    {
        return 'capell-app.content-reveal';
    }

    #[Override]
    public static function make(): Block
    {
        return Block::make(self::getWidgetName())->label(__('capell-widget-content-reveal::widget.label'))->schema([TextInput::make('heading')->required()->maxLength(120), Repeater::make('cards')->minItems(1)->maxItems(12)->reorderable()->schema([TextInput::make('title')->required()->maxLength(100), Textarea::make('teaser')->required()->maxLength(400), TextInput::make('buttonLabel')->required()->maxLength(80), self::targetSelect()->required(), Select::make('behavior')->label(__('capell-widget-content-reveal::widget.behavior'))->options(RevealBehavior::class)->default(RevealBehavior::Modal->value)->required()])]);
    }

    private static function targetSelect(): Select
    {
        return Select::make('targetInstanceId')
            ->label(__('capell-widget-content-reveal::widget.target_label'))
            ->searchable()
            ->live()
            ->options(fn (Select $component, Get $get): array => self::targetOptions($component, $get))
            ->helperText(fn (Select $component, Get $get, mixed $state): string => is_string($state) && $state !== '' && ! array_key_exists($state, self::targetOptions($component, $get))
                    ? __('capell-widget-content-reveal::widget.target_missing')
                    : __('capell-widget-content-reveal::widget.target_help'));
    }

    /** @return array<string, string> */
    private static function targetOptions(Select $component, Get $get): array
    {
        $schema = $component->getContainer();
        while (($parent = $schema->getParentComponent()) instanceof Component) {
            if ($parent instanceof ContentBuilder) {
                $state = $parent->getRawState();
                // Filament adds blocks after hydration. Persist canonical identities
                // in live state before offering targets or validating the first save.
                $state = NormalizeContentWidgetStateAction::run(is_array($state) ? $state : []);
                $parent->rawState($state);
                $sourceId = $get('../../__capell.instance_id');

                return BuildRevealTargetOptionsAction::run(
                    $state,
                    is_string($sourceId) ? $sourceId : null,
                );
            }

            $schema = $parent->getContainer();
        }

        return [];
    }
}
