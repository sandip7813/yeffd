<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    protected $fillable = ['org_image', 'mod_image', 'file_extn', 'is_dp', 'application_type', 'application_id'];
}
