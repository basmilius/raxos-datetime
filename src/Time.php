<?php
declare(strict_types=1);

namespace Raxos\DateTime;

use Cake\Chronos\ChronosTime;
use JsonSerializable;
use Raxos\Router\Contract\InjectableInterface;
use Stringable;

/**
 * Class Time
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime
 * @since 2.0.0
 */
class Time extends ChronosTime implements InjectableInterface, JsonSerializable, Stringable
{

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function jsonSerialize(): string
    {
        return (string)$this;
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function getRouterRegex(): string
    {
        return '\d{2}:\d{2}:\d{2}';
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public static function getRouterValue(string $value): self
    {
        return self::parse($value);
    }

}
