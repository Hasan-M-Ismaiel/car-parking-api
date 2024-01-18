<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
 
    protected $fillable = ['user_id', 'plate_number'];

    public function parking ()
    {
        return $this->belongsTo(Parking::class);
    }

}
