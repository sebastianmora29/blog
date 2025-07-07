<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'extracto',
        'contenido',
        'img_path',
        'user_id',
        'categoria_id', 
        'publicado',
        'publicado_en'
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'publicado_en' => 'datetime', 
    ];

    protected function image(): Attribute {

        return Attribute::make(
        get: fn ($value, $attributes) =>
            $attributes['img_path']
                ? asset('storage/' . $attributes['img_path'])
                : 'https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg'
    );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etiquetas() {
        
        return $this->belongsToMany(Etiqueta::class,  'post_etiqueta');
    }
}
