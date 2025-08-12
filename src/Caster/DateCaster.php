<?php
declare(strict_types=1);

namespace Raxos\DateTime\Caster;

use Raxos\Database\Orm\Contract\CasterInterface;
use Raxos\Database\Orm\Model;
use Raxos\DateTime\Date;

/**
 * Class DateCaster
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime\Caster
 * @since 2.0.0
 */
final readonly class DateCaster implements CasterInterface
{

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function decode(float|int|string|null $value, Model $instance): ?Date
    {
        return $value !== null ? Date::parse($value) : null;
    }

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function encode(mixed $value, Model $instance): string|float|int|null
    {
        return $value instanceof Date ? $value->toDateString() : null;
    }

}
