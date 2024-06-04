<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire_net extends Model
{
    use HasFactory;
               /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Salaire_net';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mois',
        'anne',
        'employe_id',
        
    ];
    public function Employes()
    {
        return $this->belongsTo(Employes::class, 'employe_id');
    }
}
