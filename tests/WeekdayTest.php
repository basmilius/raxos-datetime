<?php
declare(strict_types=1);

use Raxos\DateTime\{Date, DateTime, Weekday};

covers(Weekday::class);

it('maps all seven weekdays consistently across date types', function (int $offset, Weekday $expected): void {
    $date = Date::parse('2026-09-28')->addDays($offset);
    expect(Weekday::fromChronos($date))->toBe($expected)->and(Weekday::fromChronos(DateTime::parse((string)$date)))->toBe($expected);
})->with([[0, Weekday::MONDAY], [1, Weekday::TUESDAY], [2, Weekday::WEDNESDAY], [3, Weekday::THURSDAY], [4, Weekday::FRIDAY], [5, Weekday::SATURDAY], [6, Weekday::SUNDAY]]);
