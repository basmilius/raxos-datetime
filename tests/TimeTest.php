<?php
declare(strict_types=1);

use Raxos\DateTime\Time;

covers(Time::class);

it('parses and exports its wire format and supplies a matching route pattern', function (string $input, string $expected): void {
    $value = Time::fromString($input);
    expect((string)$value)->toBe($expected)->and($value->jsonSerialize())->toBe($expected)
        ->and(preg_match('#^' . Time::pattern() . '$#', $expected))->toBe(1)
        ->and(preg_match('#^' . Time::pattern() . '$#', 'invalid'))->toBe(0);
})->with([['00:00:00', '00:00:00'], ['23:59:59', '23:59:59']]);
