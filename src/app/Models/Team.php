<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Team extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'team';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_id',
        'team_number',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function classmodel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function teammates()
    {
        //一個隊伍有多個隊員
        return $this->hasMany(Teammate::class, 'id', 'team_id');
    }

    public function teamleader()
    {
        //一個隊伍有一個隊長
        return $this->hasOne(TeamLeader::class, 'id', 'team_id');
    }
}
