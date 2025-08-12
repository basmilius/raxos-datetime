<?php
declare(strict_types=1);

namespace Raxos\DateTime;

use Cake\Chronos\Chronos;
use JsonSerializable;
use Raxos\Router\Contract\InjectableInterface;
use Stringable;

/**
 * Class DateTime
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
class DateTime extends Chronos implements InjectableInterface, JsonSerializable, Stringable
{

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function jsonSerialize(): string
    {
        return $this->toIso8601String();
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function __toString(): string
    {
        return $this->toDateTimeString();
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function getRouterRegex(): string
    {
        return '\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}';
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function getRouterValue(string $value): self
    {
        return static::parse($value);
    }

}
