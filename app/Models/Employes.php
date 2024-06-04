<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employes extends Model
{
    use HasFactory;
           /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Employes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'tel',
        'adress',
        'diplome',
        'specialite',
        'img_profit',
        'contrat_id',
        'dep_id',
        
        
    ];
}



