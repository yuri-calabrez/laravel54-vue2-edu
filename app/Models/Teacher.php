<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;
use SON\Traits\UserMorphable;

class Teacher extends Model
{
    use UserMorphable;

    public function toArray()
    {
        $data = parent::toArray();
        $this->user->makeHidden(['userable_type', 'userable_id']);
        $data['user'] = $this->user;
        return $data;
    }
}
