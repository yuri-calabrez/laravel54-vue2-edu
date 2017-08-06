<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;
use SON\Traits\UserMorphable;

class Admin extends Model
{
    use UserMorphable;
}
