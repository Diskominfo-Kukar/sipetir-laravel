<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Pokmil extends Model
{
    protected $table = 'pokmil';

    protected $logName = 'pokmil';

    protected $logOnly = ['*'];

    protected $fillable = ['*'];
}
