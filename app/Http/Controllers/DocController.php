<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocController extends Controller
{
    public function index()
    {
        return redirect('/docs');
    }

    public function doc($id)
    {
        return view('doc', [
            'doc' => Doc::findOrFail($id)
        ]);
    }

    public function add(Request $request)
    {
        $doc = new Doc([
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'subject' => $request['subject'],
            'prep' => ($request['prep']) ? $request['prep'] : '', 
            'group' => $request['group'],
            'year' => $request['year'],
            'semester' => $request['semester'],
            'price' => $request['price'],
            'type' => $request['type'],
            'univer' => $request['univer'],
            'comment' => $request['comment']
        ]);
        $doc->save();

        return redirect('/');
    }

    public function search(Request $request)
    {
        $docs = Doc::limit(15)->orderByRaw('rand()');
        
        if ($request['year'] != '' && !is_numeric($request['semester']))
            $docs = Doc::orderBy('id', 'desc')
                ->where('title', 'like', '%'.$request['title'].'%')
                ->where('subject', 'like', '%'.$request['subject'].'%')
                ->where('univer', 'like', '%'.$request['univer'].'%')
                ->where('year', $request['year'])
                ->where('type', $request['type'])
                ->paginate(20);

        elseif ($request['year'] == '' && is_numeric($request['semester']))
            $docs = Doc::orderBy('id', 'desc')
                ->where('title', 'like', '%'.$request['title'].'%')
                ->where('subject', 'like', '%'.$request['subject'].'%')
                ->where('univer', 'like', '%'.$request['univer'].'%')
                ->where('semester', $request['semester'])
                ->where('type', $request['type'])
                ->paginate(20);

        elseif ($request['year'] != '' && is_numeric($request['semester']))
            $docs = Doc::orderBy('id', 'desc')
                ->where('title', 'like', '%'.$request['title'].'%')
                ->where('subject', 'like', '%'.$request['subject'].'%')
                ->where('univer', 'like', '%'.$request['univer'].'%')
                ->where('year', $request['year'])
                ->where('semester', $request['semester'])
                ->where('type', $request['type'])
                ->paginate(20);

        else
            $docs = Doc::orderBy('id', 'desc')
                ->where('title', 'like', '%'.$request['title'].'%')
                ->where('subject', 'like', '%'.$request['subject'].'%')
                ->where('univer', 'like', '%'.$request['univer'].'%')
                ->where('type', $request['type'])
                ->paginate(20);

        foreach ($docs as $doc) {
            if ((Auth::check() && Auth::user()->id !== $doc->user->id) || Auth::guest()) {
                $doc->views = $doc->views + 1;
                $doc->save();
            }
        }
        
        return view('layouts.doc-list', [
            'docs' => $docs,
            'ad_docs' => [],
            'type' => $request['type']
        ]);
    }

    public function delete(Request $request)
    {
        Doc::where('id', $request['doc_id'])->where('user_id', Auth::user()->id)->delete();
    }

    public function docs()
    {
        return $this->all(0);
    }

    public function orders()
    {
        return $this->all(1);
    }

    public function all($type)
    {
        $ad_ids = [];

        $ad_docs = Ad::where('day', date('Y-m-d'))->where('status', 1)->where('moder', 1)->orderByRaw('rand()')->get();
        foreach ($ad_docs as $ad) {
            if ((Auth::check() && (Auth::user()->id !== $ad->doc->user->id)) || Auth::guest()) {
                $ad->doc->views = $ad->doc->views + 1;
                $ad->doc->save();
            }
            array_push($ad_ids, $ad->doc->id);
        }

        $docs = Doc::orderBy('id', 'desc')->where('type', $type)->whereNotIn('id', $ad_ids)->paginate(20);
        foreach ($docs as $doc) {
            if ((Auth::check() && Auth::user()->id !== $doc->user->id) || !Auth::check()) {
                $doc->views = $doc->views + 1;
                $doc->save();
            }
        }

        return view('docs', [
            'docs' => $docs,
            'ad_docs' => $ad_docs,
            'type' => $type
        ]);
    }
}
