<?php
declare(strict_types=1);

use Raxos\DateTime\Caster\DateTimeCaster;
use Raxos\DateTime\DateTime;
use RaxosTests\DateTime\CasterModel;

covers(DateTimeCaster::class);

it('decodes database values and encodes only the expected date type', function (): void {
    $model = new CasterModel();
    $caster = new DateTimeCaster();
    $value = $caster->decode('2024-02-29 23:45:06', $model);
    expect($value)->toBeInstanceOf(DateTime::class)->and($caster->encode($value, $model))->toBe('2024-02-29 23:45:06')
        ->and($caster->decode(null, $model))->toBeNull()->and($caster->encode(null, $model))->toBeNull()
        ->and($caster->encode('invalid', $model))->toBeNull()->and($caster->encode(new stdClass(), $model))->toBeNull();
});

it('normalizes timestamps to UTC without mutating the caller value', function (): void {
    $value = DateTime::parse('2024-03-01 00:45:06', 'Europe/Amsterdam');
    expect(new DateTimeCaster()->encode($value, new CasterModel()))->toBe('2024-02-29 23:45:06')
        ->and($value->format('P'))->toBe('+01:00');
});
