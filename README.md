# PHP Type - Enum
Defines a base class for emulating enum types in php.

## Usage

```php
<?php declare(strict_types=1);

use PhpType\Enum;

final class Day extends Enum {

    public static function Monday(): Day
    {
        return new static(0);
    }

    public static function Tuesday(): Day
    {
        return new static(1);
    }

    public static function Wednesday(): Day
    {
        return new static(2);
    }

    // ...
}

function isMonday(Day $day) {
  return $day->equals(Day::Monday());
}

isMonday(Day::Monday()); // Returns true.
isMonday(Day::Tuesday()); // Returns false.
```
