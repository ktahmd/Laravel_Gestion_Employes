<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraireTravails extends Model
{
    use HasFactory;
                   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horaire_travails';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_jour',
        'heur_debit',
        'heur_fin',
        'HN',
        'HS',
        'HA',
        'employe_id',
    ];
    public function Employes()
    {
        return $this->belongsTo(Employes::class, 'employe_id');
    }
}
