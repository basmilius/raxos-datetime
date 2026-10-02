<?php
declare(strict_types=1);

use Raxos\DateTime\Caster\DateCaster;
use Raxos\DateTime\Date;
use RaxosTests\DateTime\CasterModel;

covers(DateCaster::class);

it('decodes database values and encodes only the expected date type', function (): void {
    $model = new CasterModel();
    $caster = new DateCaster();
    $value = $caster->decode('2024-02-29', $model);
    expect($value)->toBeInstanceOf(Date::class)->and($caster->encode($value, $model))->toBe('2024-02-29')
        ->and($caster->decode(null, $model))->toBeNull()->and($caster->encode(null, $model))->toBeNull()
        ->and($caster->encode('invalid', $model))->toBeNull()->and($caster->encode(new stdClass(), $model))->toBeNull();
});
