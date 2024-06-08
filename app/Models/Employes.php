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
        'img_profil',
        'user_id',
        'contrat_id',
        'dep_id',
        
        
    ];
    public function Contrats()
    {
        return $this->belongsTo(Contrats::class, 'contrat_id');
    }
    public function Departements()
    {
        return $this->belongsTo(Departements::class, 'dep_id');
    }
    public function Users()
    {
        return $this->belongsTo(User::class, 'dep_id');
    }
}



