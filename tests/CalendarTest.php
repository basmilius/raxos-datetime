<?php
declare(strict_types=1);

use Raxos\DateTime\{Date, DateTime, DateTimeUtil, Month, Time, Weekday};

it('exports dates, date-times and times in their documented wire formats', function (): void {
    $date = Date::fromString('2024-02-29');
    $time = Time::fromString('23:45:06');
    $dateTime = DateTime::parse('2024-02-29 23:45:06', 'UTC');
    expect((string)$date)->toBe('2024-02-29')->and(json_encode($date))->toBe('"2024-02-29"')
        ->and((string)$time)->toBe('23:45:06')->and(json_encode($time))->toBe('"23:45:06"')
        ->and(json_encode($dateTime))->toBe('"2024-02-29T23:45:06+00:00"');
});

it('uses ISO week years across the calendar-year boundary', function (string $date, string $week): void {
    expect(DateTimeUtil::weekIdentifier(Date::parse($date)))->toBe($week);
})->with([['2021-01-01', '2020W53'], ['2021-01-04', '2021W01'], ['2024-12-30', '2025W01']]);

it('maps all months and weekdays from actual calendar dates', function (int $month): void {
    $date = Date::parse(sprintf('2024-%02d-01', $month));
    expect(Month::fromChronos($date)->value)->toBe($month);
})->with(range(1, 12));

it('converts time strings without losing zero-valued segments', function (string $time, int $seconds): void {
    expect(DateTimeUtil::timeToSeconds($time))->toBe($seconds);
})->with([['00:00:00', 0], ['01:02:03', 3723], ['12:30', 45000], ['23:59:59', 86399]]);
