<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directeurs extends Model
{
    use HasFactory;
           /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Directeurs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'employe_id',
        
    ];
}



