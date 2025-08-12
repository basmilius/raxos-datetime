<?php
declare(strict_types=1);

namespace Raxos\DateTime;

/**
 * Enum Month
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
enum Month: int
{
    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;

    /**
     * Returns the month from the given chronos date.
     *
     * @param Date|DateTime $dateTime
     *
     * @return self
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function fromChronos(Date|DateTime $dateTime): self
    {
        return match ($dateTime->month) {
            1 => self::JANUARY,
            2 => self::FEBRUARY,
            3 => self::MARCH,
            4 => self::APRIL,
            5 => self::MAY,
            6 => self::JUNE,
            7 => self::JULY,
            8 => self::AUGUST,
            9 => self::SEPTEMBER,
            10 => self::OCTOBER,
            11 => self::NOVEMBER,
            12 => self::DECEMBER
        };
    }
}
