<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRH extends Model
{
    use HasFactory;
               /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'RRH';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'employe_id',
        
    ];
}
