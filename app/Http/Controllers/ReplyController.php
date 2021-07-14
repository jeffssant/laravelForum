<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Thread;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request){
        try {
            $reply = $request->all();
            $reply['user_id']= 1;

            $thread = Thread::find($request->thread_id);
            $thread->replies()->create($reply);


            flash('Resposta publicada com sucesso')->success();

            return redirect()->back();

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : "Erro ao processar requisição";

            flash($message)->warning();
            return redirect()->back();

        }
    }
}
