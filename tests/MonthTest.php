<?php
declare(strict_types=1);

use Raxos\DateTime\{Date, DateTime, Month};

covers(Month::class);

it('maps every month for date-only and date-time values', function (int $month): void {
    $raw = sprintf('2024-%02d-01', $month);
    expect(Month::fromChronos(Date::parse($raw)))->toBe(Month::from($month))
        ->and(Month::fromChronos(DateTime::parse($raw)))->toBe(Month::from($month));
})->with(range(1, 12));
