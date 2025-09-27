<?php
declare(strict_types=1);

namespace Raxos\DateTime\Constraint;

use Attribute;
use Raxos\Contract\Http\Validate\ConstraintAttributeInterface;
use Raxos\DateTime\Date;
use Raxos\Http\Validate\Error\ConstraintErrorException;
use ReflectionProperty;
use function is_string;
use function preg_match;

/**
 * Class IsDate
 *
 * @author Bas Milius <bas@mili.us>
 * @package Raxos\DateTime\Constraint
 * @since 2.0.0
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final readonly class IsDate implements ConstraintAttributeInterface
{

    public const string REGEXP = /* @lang PhpRegExp */
        '/\d{4}-\d{2}-\d{2}/';

    /**
     * {@inheritdoc}
     * @author Bas Milius <bas@mili.us>
     * @since 2.0.0
     */
    public function check(ReflectionProperty $property, mixed $value): Date
    {
        if (!is_string($value) || !preg_match(self::REGEXP, $value)) {
            throw new ConstraintErrorException(
                'is_date',
                'Invalid date.'
            );
        }

        return Date::parse($value);
    }

}
