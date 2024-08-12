<?php

declare(strict_types=1);

namespace App\User\Domain;

enum Status: string
{
    case Active = 'active';
    case Suspended = 'suspended';
    case Cancelled = 'cancelled';
    case Banned = 'banned';
}
