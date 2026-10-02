<?php
declare(strict_types=1);

use Raxos\DateTime\{DateTime};

covers(DateTime::class);

it('exports date-times in ISO format while preserving timezone and immutability', function (): void {
    $value = DateTime::fromString('2024-02-29T23:45:06');
    expect($value->jsonSerialize())->toBe('2024-02-29T23:45:06+00:00')->and((string)$value)->toBe('2024-02-29 23:45:06')
        ->and(preg_match('#^' . DateTime::pattern() . '$#', '2024-02-29T23:45:06'))->toBe(1);
    $shifted = $value->setTimezone('Europe/Amsterdam');
    expect($shifted->format('Y-m-d H:i:s P'))->toBe('2024-03-01 00:45:06 +01:00')
        ->and($value->format('Y-m-d H:i:s P'))->toBe('2024-02-29 23:45:06 +00:00');
});

it('crosses the Amsterdam daylight-saving boundary correctly', function (): void {
    $value = DateTime::parse('2026-03-29 01:30:00', 'Europe/Amsterdam');
    expect($value->addHours(1)->format('Y-m-d H:i P'))->toBe('2026-03-29 03:30 +02:00')
        ->and($value->jsonSerialize())->toBe('2026-03-29T01:30:00+01:00');
});
