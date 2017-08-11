<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;
use SON\Traits\UserMorphable;

class Student extends Model
{
    use UserMorphable;
}
