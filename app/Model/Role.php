<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    const _ADMIN = 1;
    const _HRMANAGER = 2;
    const _HR = 3;
    const _APPLICANT = 4;
}
