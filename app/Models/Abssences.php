<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abssences extends Model
{
    use HasFactory;
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Abssences';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'durre',
        'Horaire_id',
        
        
    ];
    public function HoraireTravails()
    {
        return $this->belongsTo(HoraireTravails::class, 'horaire_id');
    }
}

