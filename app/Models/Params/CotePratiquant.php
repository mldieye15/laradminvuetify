<?php

namespace App\Models\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotePratiquant extends Model
{
    use HasFactory;

    protected $table = 'cote_pratiquants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'active'
    ];
}
