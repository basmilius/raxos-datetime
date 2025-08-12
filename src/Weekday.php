<?php
declare(strict_types=1);

namespace Raxos\DateTime;

/**
 * Enum Weekday
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
enum Weekday: int
{
    case SUNDAY = 0;
    case MONDAY = 1;
    case TUESDAY = 2;
    case WEDNESDAY = 3;
    case THURSDAY = 4;
    case FRIDAY = 5;
    case SATURDAY = 6;

    /**
     * Returns the weekday from the given chronos date.
     *
     * @param Date|DateTime $dateTime
     *
     * @return self
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function fromChronos(Date|DateTime $dateTime): self
    {
        return match ($dateTime->dayOfWeek) {
            1 => self::MONDAY,
            2 => self::TUESDAY,
            3 => self::WEDNESDAY,
            4 => self::THURSDAY,
            5 => self::FRIDAY,
            6 => self::SATURDAY,
            7 => self::SUNDAY
        };
    }
}
