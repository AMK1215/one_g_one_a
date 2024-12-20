<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerText extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'agent_id'
    ];

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
