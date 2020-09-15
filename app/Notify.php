<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $fillable = ['from_user', 'to_user', 'doc_id', 'date'];

    public $timestamps = false;

    public function fromUser()
    {
        return $this->belongsTo('App\User', 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo('App\User', 'to_user');
    }

    public function doc()
    {
        return $this->belongsTo('App\Doc');
    }
}
