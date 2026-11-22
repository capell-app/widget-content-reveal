<?php

declare(strict_types=1);

use Capell\Core\Data\Rendering\FrontendRuntimeManifestData;
use Capell\Core\Enums\Rendering\RenderingStrategyEnum;
use Capell\Frontend\Data\Assets\FrontendResourcePlanData;
use Capell\Frontend\Data\PublicPageRenderData;
use Capell\WidgetContentReveal\Data\ContentRevealRenderData;
use Capell\WidgetContentReveal\Data\RevealCardData;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Spatie\LaravelData\DataCollection;

require dirname(__DIR__, 4) . '/vendor/autoload.php';

// Render the shipped widget Blade without a database so a browser test can run Core's interaction runtime against it.
$root = dirname(__DIR__, 2) . '/resources';
$cache = sys_get_temp_dir() . '/content-reveal-blade-' . bin2hex(random_bytes(8));
mkdir($cache);
$files = new Filesystem;
$container = new Application(dirname(__DIR__, 4));
Container::setInstance($container);
$container->instance('config', new Repository(['app' => ['locale' => 'en', 'fallback_locale' => 'en']]));
$loader = new FileLoader($files, $root . '/lang');
$loader->addNamespace('capell-widget-content-reveal', $root . '/lang');
$translator = new Translator($loader, 'en');
$container->instance('translator', $translator);
Facade::setFacadeApplication($container);
$engines = new EngineResolver;
$engines->register('php', static fn (): PhpEngine => new PhpEngine($files));
$engines->register('blade', static fn (): CompilerEngine => new CompilerEngine(new BladeCompiler($files, $cache)));
$finder = new FileViewFinder($files, [$root . '/views']);
$finder->addNamespace('capell-widget-content-reveal', $root . '/views');
$views = new Factory($engines, $finder, new Dispatcher($container));
$views->setContainer($container);
$views->share('__env', $views);
$container->instance('view', $views);

try {
    $cards = json_decode((string) stream_get_contents(STDIN), true, flags: JSON_THROW_ON_ERROR);
    throw_unless(is_array($cards), InvalidArgumentException::class, 'Cards must be a list.');
    $locators = [];
    $revealCards = [];
    foreach ($cards as $card) {
        throw_unless(is_array($card), InvalidArgumentException::class, 'Each card must be an object.');
        ['title' => $title, 'teaser' => $teaser, 'buttonLabel' => $buttonLabel, 'targetInstanceId' => $targetId, 'behavior' => $behavior] = $card;
        throw_unless(is_string($title) && is_string($teaser) && is_string($buttonLabel) && is_string($targetId) && is_string($behavior), InvalidArgumentException::class, 'Card fields must be strings.');
        $locators[$targetId] = '/widgets/' . $targetId;
        $revealCards[] = new RevealCardData($title, $teaser, $buttonLabel, $targetId, $behavior);
    }

    $pageData = new PublicPageRenderData(
        layoutGraph: null,
        runtimeManifest: FrontendRuntimeManifestData::forRenderingStrategy(RenderingStrategyEnum::BladeOnly),
        resourcePlan: new FrontendResourcePlanData([], [], [], [], [], [], [], ''),
        surrogateKeys: [],
        widgetInteractionLocators: $locators,
    );
    echo $views->make('capell-widget-content-reveal::widget', [
        'renderData' => new ContentRevealRenderData('More', new DataCollection(RevealCardData::class, $revealCards)),
        'publicPageRenderData' => $pageData,
    ])->render();
} finally {
    $files->deleteDirectory($cache);
}
