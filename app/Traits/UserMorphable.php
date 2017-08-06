<?php
namespace SON\Traits;

use SON\Models\User;

trait UserMorphable
{
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}