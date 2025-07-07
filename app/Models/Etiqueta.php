<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    /** @use HasFactory<\Database\Factories\EtiquetaFactory> */
    use HasFactory;
    
    protected $fillable = ['nombre'];

    public function posts() {
        
        return $this->belongsToMany(Post::class,  'post_etiqueta');
    }
}
