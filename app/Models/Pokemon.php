<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Pokemon extends Model
{
    public static function getRandomPair()
    {
        return self::inRandomOrder()->limit(2)->get();
    }
}
