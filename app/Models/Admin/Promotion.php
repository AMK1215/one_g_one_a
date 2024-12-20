<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'title' , 'description', 'agent_id'
    ];

    protected $appends = ['img_url'];

    public function getImgUrlAttribute()
    {
        return asset('assets/img/promotions/'.$this->image);
    }

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
