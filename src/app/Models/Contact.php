<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable =[
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    protected $perPage = 7;
    
    public function getTelAttribute()
    {
        return $this->tel1 . '-' . $this->tel2 . '-' . $this->tel3;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
    return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
