<?php
declare(strict_types=1);

use Raxos\DateTime\DateTime;
use Raxos\Error\InvalidArgumentException;

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

it('accepts its ISO wire format and preserves the represented instant', function (string $input): void {
    expect(preg_match('#^(?:' . DateTime::pattern() . ')$#D', $input))->toBe(1);
    $date = DateTime::fromString($input);
    expect(preg_match('#^(?:' . DateTime::pattern() . ')$#D', $date->jsonSerialize()))->toBe(1)
        ->and(DateTime::fromString($date->jsonSerialize())->getTimestamp())->toBe($date->getTimestamp());
})->with(['2024-02-29T12:30:00Z', '2026-01-02T03:04:05+02:00', '2026-01-02T03:04:05-05:30', '2026-01-02T03:04:05.123456+00:00']);

it('rejects malformed ISO route segments', function (string $input): void {
    expect(preg_match('#^(?:' . DateTime::pattern() . ')$#D', $input))->toBe(0);
})->with(['2026-01-02 03:04:05', '2026-01-02T03:04:05+0200', '2026-01-02T03:04:05.1234567Z', 'x2026-01-02T03:04:05Z']);

it('rejects impossible ISO dates and times instead of silently normalizing them', function (string $input): void {
    expect(fn() => DateTime::fromString($input))->toThrow(InvalidArgumentException::class);
})->with(['2026-02-29T12:00:00Z', '2026-04-31T12:00:00+02:00', '2026-10-01T24:00:00Z', '2026-10-01T12:60:00Z', '2026-10-01T12:00:60Z', '2026-10-01T12:00:00+24:00']);

it('accepts leap days and preserves the existing natural-language parsing API', function (): void {
    expect(DateTime::fromString('2028-02-29T12:00:00Z')->day)->toBe(29)
        ->and(DateTime::fromString('tomorrow'))->toBeInstanceOf(DateTime::class);
});
