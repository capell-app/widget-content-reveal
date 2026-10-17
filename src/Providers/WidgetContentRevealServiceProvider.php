<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Providers;

use Capell\Core\Enums\InteractionBehavior;
use Capell\Core\Enums\InteractionTargetType;
use Capell\Core\Enums\InteractionTriggerEvent;
use Capell\Core\Enums\PresentationLoadingStrategy;
use Capell\LayoutBuilder\Data\WidgetExtensions\WidgetExtensionCapabilitiesData;
use Capell\LayoutBuilder\Data\WidgetExtensions\WidgetExtensionDefinitionData;
use Capell\LayoutBuilder\Enums\WidgetPresentationCapability;
use Capell\LayoutBuilder\Providers\AbstractFoundationWidgetServiceProvider;
use Capell\WidgetContentReveal\Data\ContentRevealInputData;
use Capell\WidgetContentReveal\Data\ContentRevealRenderData;
use Capell\WidgetContentReveal\Filament\ContentRevealWidget;
use Override;

final class WidgetContentRevealServiceProvider extends AbstractFoundationWidgetServiceProvider
{
    public static string $name = 'capell-widget-content-reveal';

    public static string $packageName = 'capell-app/widget-content-reveal';

    #[Override]
    public function packageBooted(): void {}

    #[Override]
    protected static function resourceGroup(): string
    {
        return 'capell-app.widget-content-reveal';
    }

    #[Override]
    protected static function scriptLoadingStrategy(): PresentationLoadingStrategy
    {
        return PresentationLoadingStrategy::Interaction;
    }

    #[Override]
    protected function bootInstalledRuntime(): void
    {
        $this->registerWidget();
    }

    #[Override]
    protected function definition(): WidgetExtensionDefinitionData
    {
        return new WidgetExtensionDefinitionData(key: 'capell-app.content-reveal', packageName: self::$packageName, stateVersion: 1, filamentWidget: ContentRevealWidget::class, inputData: ContentRevealInputData::class, renderData: ContentRevealRenderData::class, fallbackView: 'capell-widget-content-reveal::widget', components: ['blade' => 'capell::widgets.capell-app.content-reveal'], resourceGroups: [self::resourceGroup()], defaultResourceLoadingStrategy: PresentationLoadingStrategy::Interaction, capabilities: new WidgetExtensionCapabilitiesData(supportsInteractions: true, requiresInstanceIdentity: true, presentationCapabilities: [WidgetPresentationCapability::Width, WidgetPresentationCapability::Alignment, WidgetPresentationCapability::LoadingStrategy], supportedInteractionEvents: [InteractionTriggerEvent::Click], supportedInteractionBehaviors: [InteractionBehavior::Modal, InteractionBehavior::SlideOver, InteractionBehavior::InlineReveal, InteractionBehavior::ReplaceRegion], supportedInteractionTargetTypes: [InteractionTargetType::Widget]));
    }
}
