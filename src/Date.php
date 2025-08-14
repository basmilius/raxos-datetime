<?php
declare(strict_types=1);

namespace Raxos\DateTime;

use Cake\Chronos\ChronosDate;
use JsonSerializable;
use Raxos\Foundation\Contract\StringParsableInterface;
use Stringable;

/**
 * Class Date
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
class Date extends ChronosDate implements JsonSerializable, Stringable, StringParsableInterface
{

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function jsonSerialize(): string
    {
        return $this->toDateString();
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function __toString(): string
    {
        return $this->toDateString();
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function fromString(string $input): self
    {
        return self::parse($input);
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function pattern(): string
    {
        return '\d{4}-\d{2}-\d{2}';
    }

}
