<?php
declare(strict_types=1);

use Raxos\DateTime\Date;
use Raxos\DateTime\DateTime;
use Raxos\DateTime\Weekday;

it('round trips date-only values without timezone shifts', function (): void {
    $date = Date::fromString('2024-02-29');
    expect((string)$date)->toBe('2024-02-29');
    expect(json_encode($date))->toBe('"2024-02-29"');
    expect((string)$date->addDays(1))->toBe('2024-03-01');
    expect((string)$date)->toBe('2024-02-29');
});

it('maps the first and last weekday correctly', function (): void {
    expect(Weekday::fromChronos(Date::parse('2026-09-28')))->toBe(Weekday::MONDAY);
    expect(Weekday::fromChronos(Date::parse('2026-10-04')))->toBe(Weekday::SUNDAY);
});

it('serializes offsets and handles the Amsterdam daylight saving boundary', function (): void {
    $time = DateTime::parse('2026-03-29 01:30:00', 'Europe/Amsterdam');
    expect($time->addHours(1)->format('Y-m-d H:i P'))->toBe('2026-03-29 03:30 +02:00');
    expect(json_decode(json_encode($time), true))->toBe('2026-03-29T01:30:00+01:00');
});
