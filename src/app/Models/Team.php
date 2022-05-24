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
        'created_at',
        'updated_at',
        'creator',
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
        return $this->hasMany(Teammate::class, 'team_id', 'id');
    }

    public function teamleader()
    {
        //一個隊伍有一個隊長
        return $this->hasOne(TeamLeader::class, 'team_id', 'id');
    }

    public function teaminvite()
    {
        return $this->hasMany(TeamInvite::class, 'team_id', 'id');
    }

    public function topic()
    {
        //一個隊伍有一個隊長
        return $this->hasOne(Topic::class, 'team_id', 'id');
    }
}
