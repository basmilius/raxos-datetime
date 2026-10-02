<?php
declare(strict_types=1);

use Raxos\DateTime\Date;

covers(Date::class);

it('parses and exports its wire format and supplies a matching route pattern', function (string $input, string $expected): void {
    $value = Date::fromString($input);
    expect((string)$value)->toBe($expected)->and($value->jsonSerialize())->toBe($expected)
        ->and(preg_match('#^' . Date::pattern() . '$#', $expected))->toBe(1)
        ->and(preg_match('#^' . Date::pattern() . '$#', 'invalid'))->toBe(0);
})->with([['2024-02-29', '2024-02-29'], ['2024-12-31', '2024-12-31']]);

it('keeps date arithmetic immutable across leap-day and year boundaries', function (): void {
    $date = Date::fromString('2024-02-29');
    expect((string)$date->addDays(1))->toBe('2024-03-01')->and((string)$date)->toBe('2024-02-29');
});
