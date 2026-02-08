<?php
declare(strict_types=1);

namespace Raxos\DateTime\Caster;

use Raxos\Contract\Database\Orm\CasterInterface;
use Raxos\Database\Orm\Model;
use Raxos\DateTime\DateTime;

/**
 * Class DateTimeCaster
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime\Caster
 * @since 2.0.0
 */
final readonly class DateTimeCaster implements CasterInterface
{

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function decode(float|int|string|null $value, Model $instance): ?DateTime
    {
        return $value !== null ? DateTime::parse($value, 'UTC') : null;
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function encode(mixed $value, Model $instance): string|float|int|null
    {
        return $value instanceof DateTime ? $value->setTimezone('UTC')->toDateTimeString() : null;
    }

}
