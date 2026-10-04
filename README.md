<a href="https://bas.dev">
    <img src="https://bmcdn.nl/assets/branding/logo.svg" alt="Bas Milius" height="48" />
</a>

---

# Raxos DateTime

Immutable date, time and timestamp objects built on CakePHP Chronos.

[Documentation](https://raxos.dev/datetime/) | [Packagist](https://packagist.org/packages/raxos/datetime) | [Raxos](https://github.com/basmilius/raxos)

- `Date`, `Time` and `DateTime` with Chronos arithmetic and formatting.
- JSON serialization and parsing through `StringParsableInterface`.
- Month and weekday enums, date utilities and ORM casters.

## Installation

Requires PHP 8.5 or later. Composer checks the remaining package and extension dependencies declared in [composer.json](composer.json).

```sh
composer require "raxos/datetime:^3.3"
```

## Usage

```php
<?php
declare(strict_types=1);

use Raxos\DateTime\Date;
use Raxos\DateTime\DateTime;
use Raxos\DateTime\Time;

require __DIR__ . '/vendor/autoload.php';

$date = Date::parse('2026-10-03');
$tomorrow = $date->addDays(1);
$time = Time::parse('14:30:00');
$moment = DateTime::parse('2026-10-03 14:30:00', 'UTC');

echo json_encode(['date' => $tomorrow, 'time' => $time, 'moment' => $moment]);
```

Arithmetic returns new instances. Choose a timezone explicitly for timestamps; `Date` represents a calendar date and `Time` a time of day. Use the ORM casters with `raxos/database` installed.

## Documentation

- [Date, Time and DateTime](https://raxos.dev/datetime/value-objects)
- [Enums and utilities](https://raxos.dev/datetime/enums-and-utilities)
- [ORM casters](https://raxos.dev/datetime/orm-casters)

## Testing

Run this library's Pest suite from the Raxos workspace:

```sh
git clone --recurse-submodules https://github.com/basmilius/raxos.git
cd raxos
composer install
vendor/bin/pest --testsuite=datetime
```

See [Testing Raxos](https://github.com/basmilius/raxos/blob/main/TESTING.md) for PHP extensions, integration services and coverage commands. The library's [Tests workflow](.github/workflows/tests.yml) also runs in GitHub Actions.

## License

[MIT](LICENSE). Copyright (c) 2017 - present Bas Milius.

See [datetime route round trips](https://raxos.dev/datetime/route-roundtrips) for the optional APIs and their lifetime or transport guarantees.
