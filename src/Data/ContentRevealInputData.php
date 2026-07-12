<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class ContentRevealInputData extends Data
{
    /** @param DataCollection<int, RevealCardData> $cards */
    public function __construct(public string $heading, #[DataCollectionOf(RevealCardData::class)] public DataCollection $cards) {}

    /** @return array<string, list<string>> */
    public static function rules(): array
    {
        return ['heading' => ['required', 'string', 'max:120'], 'cards' => ['required', 'array', 'min:1', 'max:12']];
    }
}
