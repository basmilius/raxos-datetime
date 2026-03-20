<?php
declare(strict_types=1);

namespace Raxos\DateTime;

use function array_map;

/**
 * Class DateTimeUtil
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
final class DateTimeUtil
{

    /**
     * Converts the given time string to seconds.
     *
     * @param string $time
     *
     * @return int
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function timeToSeconds(string $time): int
    {
        $parts = explode(':', $time)
                |> (fn($x) => array_map('intval', $x))
                |> (fn($x) => array_pad($x, 3, 0));

        return $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
    }

    /**
     * Returns the week identifier for the given date.
     *
     * @param Date|DateTime $date
     *
     * @return string
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function weekIdentifier(Date|DateTime $date): string
    {
        return $date->format('o\WW');
    }

}
