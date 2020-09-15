<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function notify(Request $request)
    {
        if (!Notify::where('date', date('Y-m-d'))
            ->where('doc_id', $request['doc'])
            ->where('from_user', Auth::user()->id)
            ->where('to_user', Doc::findOrFail($request['doc'])->user->id)->first()) {
            
            $notify = new Notify([
                'from_user' => Auth::user()->id,
                'to_user' => Doc::findOrFail($request['doc'])->user->id,
                'doc_id' => $request['doc'],
                'date' => date('Y-m-d')
            ]);
            $notify->save();

            return 'Сообщение владельцу документа успешно отправлено! Теперь он может связаться с вами.';
        } else
            return response('Вы сегодня уже отправляли уведомление владельцу!', 500);
    }
}
