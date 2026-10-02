<?php
declare(strict_types=1);

use Raxos\DateTime\Caster\TimeCaster;
use Raxos\DateTime\Time;
use RaxosTests\DateTime\CasterModel;

covers(TimeCaster::class);

it('decodes database values and encodes only the expected date type', function (): void {
    $model = new CasterModel();
    $caster = new TimeCaster();
    $value = $caster->decode('23:45:06', $model);
    expect($value)->toBeInstanceOf(Time::class)->and($caster->encode($value, $model))->toBe('23:45:06')
        ->and($caster->decode(null, $model))->toBeNull()->and($caster->encode(null, $model))->toBeNull()
        ->and($caster->encode('invalid', $model))->toBeNull()->and($caster->encode(new stdClass(), $model))->toBeNull();
});
