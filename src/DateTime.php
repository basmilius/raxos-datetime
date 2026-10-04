<?php
declare(strict_types=1);

namespace Raxos\DateTime;

use Cake\Chronos\Chronos;
use JsonSerializable;
use Raxos\Error\InvalidArgumentException;

use Raxos\Foundation\Contract\StringParsableInterface;
use Stringable;
use function checkdate;
use function preg_match;

/**
 * Class DateTime
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
class DateTime extends Chronos implements JsonSerializable, Stringable, StringParsableInterface
{

    /**
     * {@inheritdoc}
     *
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function jsonSerialize(): string
    {
        return $this->toIso8601String();
    }

    /**
     * {@inheritdoc}
     *
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function __toString(): string
    {
        return $this->toDateTimeString();
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function fromString(string $input): static
    {
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})(?:\.\d{1,6})?(?:Z|[+-](\d{2}):(\d{2}))?$/D', $input, $parts)) {
            if (!checkdate((int)$parts[2], (int)$parts[3], (int)$parts[1]) || (int)$parts[4] > 23 || (int)$parts[5] > 59 || (int)$parts[6] > 59 || (int)($parts[7] ?? 0) > 23 || (int)($parts[8] ?? 0) > 59) {
                throw new InvalidArgumentException('Invalid ISO date or time.');
            }
        }

        return static::parse($input);
    }

    /**
     * {@inheritdoc}
     *
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function pattern(): string
    {
        return '\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(?:\.\d{1,6})?(?:Z|[+-]\d{2}:\d{2})?';
    }

}
