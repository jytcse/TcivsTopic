<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TeamLeader extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'teamleader';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'user_id',
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

    public function team()
    {
        //隊長屬於一個隊伍
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function teammate()
    {
        //隊長是哪個隊員
        return $this->hasOne(Teammate::class, 'id', 'user_id');
    }
}
