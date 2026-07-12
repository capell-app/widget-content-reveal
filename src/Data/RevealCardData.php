<?php

declare(strict_types=1);

namespace Capell\WidgetContentReveal\Data;

use Spatie\LaravelData\Data;

final class RevealCardData extends Data
{
    public function __construct(public string $title, public string $teaser, public string $buttonLabel, public string $targetInstanceId, public string $behavior = 'modal') {}

    /** @return array<string, list<string>> */
    public static function rules(): array
    {
        return ['title' => ['required', 'string', 'max:100'], 'teaser' => ['required', 'string', 'max:400'], 'buttonLabel' => ['required', 'string', 'max:80'], 'targetInstanceId' => ['required', 'uuid'], 'behavior' => ['required', 'in:modal,slide_over,inline_reveal,replace_region']];
    }
}
