<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function new(Request $request)
    {
        if (Ad::where('day', date('Y-m-d', strtotime($request['date'])))->where('doc_id', $request['doc_id'])->first())
            return response('У выбранного документа в указанный день уже зарегистрирована реклама!', 500);
            
        $ad = new Ad([
            'doc_id' => $request['doc_id'],
            'day' => date('Y-m-d', strtotime($request['date'])),
            'hash' => Str::random(50)
        ]);
        $ad->save();

        return json_encode([
            'bill' => 410011502711398,
            'amount' => 50,
            'ad_id' => $ad->id,
            'hash' => $ad->hash
        ]);
    }

    public function success($id, $hash)
    {
        $ad = Ad::where('id', $id)->where('hash', $hash)->firstOrFail();
        $ad->status = 1;
        $ad->save();
        return redirect('/');
    }
}
