<?php

namespace App\Enums\User;

enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
}
