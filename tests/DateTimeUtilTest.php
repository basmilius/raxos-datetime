<?php
declare(strict_types=1);

use Raxos\DateTime\{Date, DateTime, DateTimeUtil};

covers(DateTimeUtil::class);

it('converts complete, shortened and zero-valued times into seconds', function (string $time, int $seconds): void {
    expect(DateTimeUtil::timeToSeconds($time))->toBe($seconds);
})->with([['00:00:00', 0], ['01:02:03', 3723], ['12:30', 45000], ['12', 43200], ['23:59:59', 86399]]);

it('uses ISO week years across calendar-year boundaries for either date type', function (string $date, string $expected): void {
    expect(DateTimeUtil::weekIdentifier(Date::parse($date)))->toBe($expected)
        ->and(DateTimeUtil::weekIdentifier(DateTime::parse($date)))->toBe($expected);
})->with([['2021-01-01', '2020W53'], ['2021-01-04', '2021W01'], ['2024-12-30', '2025W01']]);
