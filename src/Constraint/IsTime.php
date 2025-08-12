<?php
declare(strict_types=1);

namespace Raxos\DateTime\Constraint;

use Attribute;
use Raxos\DateTime\Time;
use Raxos\Http\Validate\Contract\ConstraintAttributeInterface;
use Raxos\Http\Validate\Error\HttpConstraintException;
use ReflectionProperty;
use function is_string;
use function preg_match;

/**
 * Class IsTime
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime\Constraint
 * @since 2.0.0
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final readonly class IsTime implements ConstraintAttributeInterface
{

    public const string REGEXP = /* @lang PhpRegExp */
        '/\d{2}:\d{2}:\d{2}/';

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function check(ReflectionProperty $property, mixed $value): Time
    {
        if (!is_string($value) || !preg_match(self::REGEXP, $value)) {
            throw HttpConstraintException::of(
                'is_time',
                'Invalid time.'
            );
        }

        return Time::parse($value);
    }

}
