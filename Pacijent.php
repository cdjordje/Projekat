<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacijent extends Model
{
    public $timestamps = false;
    protected $table='pacijent';
    protected $primaryKey="pacijent_id";
}
