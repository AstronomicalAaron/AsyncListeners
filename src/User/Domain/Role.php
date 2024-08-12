<?php

declare(strict_types=1);

namespace App\User\Domain;

enum Role: string
{
    case User = 'user';
    case Admin = 'admin';
    case Support = 'support';
}
