<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class ContentRevealRenderData extends Data
{
    /** @param DataCollection<int, RevealCardData> $cards */
    public function __construct(public string $heading, #[DataCollectionOf(RevealCardData::class)] public DataCollection $cards) {}
}
