<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
                   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contenu',
        'employe_id',
        'employe_id_1',
        
        
        
    ];
}
