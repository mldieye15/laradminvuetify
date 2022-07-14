<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNatioSportIdentity extends Model
{
    use HasFactory;

    protected $table = 'user_natio_sport_identities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'ins',
    ];

    /**
     * Return the user.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
