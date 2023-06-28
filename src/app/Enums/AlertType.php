<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AlertType extends Enum
{
    const ERROR = 0;
    const SUCCESS = 1;
    const INFO = 2;
    const WARNING = 3;
}
