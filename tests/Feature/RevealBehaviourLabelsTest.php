<?php

declare(strict_types=1);

use Capell\Core\Facades\CapellCore;
use Capell\WidgetContentReveal\Enums\RevealBehavior;
use Capell\WidgetContentReveal\Filament\ContentRevealWidget;
use Capell\WidgetContentReveal\Providers\WidgetContentRevealServiceProvider;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

beforeEach(function (): void {
    CapellCore::forcePackageInstalled('capell-app/widget-content-reveal');
    $this->app->register(WidgetContentRevealServiceProvider::class);
});

/*
 * Bug caught: the editor showed the raw field label "Behavior" and developer
 * option names ("Modal", "Slide-over", "Inline reveal", "Replace region").
 */
it('labels the reveal choice in plain words for editors', function (): void {
    $select = null;

    $children = ContentRevealWidget::make()->getDefaultChildComponents();
    assert(is_array($children));

    foreach ($children as $component) {
        if (! $component instanceof Repeater) {
            continue;
        }

        $fields = $component->getDefaultChildComponents();
        assert(is_array($fields));

        foreach ($fields as $field) {
            if ($field instanceof Select && $field->getName() === 'behavior') {
                $select = $field;
            }
        }
    }

    $this->assertInstanceOf(Select::class, $select);
    expect($select->getLabel())->toBe('How it opens')
        ->and($select->getOptions())->toBe([
            'modal' => 'Pop-up',
            'slide_over' => 'Side panel',
            'inline_reveal' => 'Open below the button',
            'replace_region' => 'Replace the button',
        ])
        ->and(RevealBehavior::Modal->getLabel())->toBe('Pop-up');
});
