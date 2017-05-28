<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carro extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Indica quais campos não podem ser preenchidos manualmente pelo usuário
     * @var array
     */
    protected $guarded = ['id'];

    static $rules = [
        'nome' => 'required|min:3|max:150',
        'placa' => 'required|min:7|max:7|unique:carros'
    ];

    /**
     * Relacionamento de um para um
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getChassi()
    {
        return $this->hasOne('App\Models\Painel\CarrosChassi', 'id_carro');
    }

    /**
     * Relacionamento um para muitos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getMarca()
    {
        return $this->hasMany('App\Models\Painel\MarcasCarro', 'id', 'id_marca');
    }

    /**
     * Relacionamento muitos para muitos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getCores()
    {
        return $this->belongsToMany('App\Models\Painel\CoresCarro', 'cores_carros', 'id_cor', 'id_carro');
    }
}
