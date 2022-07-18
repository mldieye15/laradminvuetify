<?php

namespace App\Models\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradePratiquant extends Model
{
    use HasFactory;

    protected $table = 'grade_pratiquants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'age_min',
        'age_max',
        'active',
        'niveau'
    ];
}
