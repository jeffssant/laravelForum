<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    private $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->channel);
        $channelParam = $request->channel;
        if($channelParam){
            $threads = Channel::whereSlug($channelParam)->first()->threads()->paginate(15);
        }else {
            $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(15);
        }

        return view('threads.index', compact('threads'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create' , [
            'channels' => Channel::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);

            $user = User::find(1);

            $thread = $user->threads()->create($thread);

            flash('Tópico criado com sucesso')->success();

            return redirect()->route('threads.show', $thread->slug);

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : "Erro ao processar requisição";

            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $thread = $this->thread->whereSlug($slug)->first();

        if(!$thread) return redirect()->route('threads.index');

        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $thread = $this->thread->whereSlug($slug)->first();
        $channels = Channel::all();


        return view('threads.edit', compact('thread', 'channels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        try {

            $thread = $this->thread->whereSlug($slug)->first();
            $thread->update($request->all());

            flash('Tópico atualizado com sucesso')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : "Erro ao processar requisição";

            flash($message)->warning();
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {

            $thread = $this->thread->whereSlug($slug)->first();
            $thread->delete();

            flash('Tópico removido com sucesso')->success();
            return redirect()->route('threads.index');

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : "Erro ao processar requisição";

            flash($message)->warning();
            return redirect()->back();

        }
    }
}
