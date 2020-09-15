<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doc extends Model
{
    protected $fillable = [
        'user_id', 'title', 'prep', 'subject', 'group', 'year', 'semester', 'price', 'views', 'type', 'univer', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ad()
    {
        return $this->hasMany('App\Ad');
    }

    public function scopeIsAd($query, $id)
    {
        return (Ad::where('doc_id', $id)->where('day', date('Y-m-d'))->where('status', 1)->where('moder', 1)->first()) ? true : false;
    }

    public function scopeWithAd($query)
    {
        return $query->whereIn('doc_id', Ad::where('day', date('Y-m-d'))->where('status', 1)->where('moder', 1)->get('id'));
    }
}
