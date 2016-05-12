<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class World extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'worlds';
    protected $primaryKey = '_id';
}
