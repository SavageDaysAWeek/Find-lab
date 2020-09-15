<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'doc_id', 'day', 'pay_date', 'status', 'hash'
    ];

    public function doc()
    {
        return $this->belongsTo('App\Doc');
    }
}
