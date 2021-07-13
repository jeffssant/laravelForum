<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(15);

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
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

            $user = User::find(31);

            $user->threads()->create($thread);

            dd('Tópico criado com sucesso');

        } catch (\Exception $e) {

            dd($e->getMessage());

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

        return view('threads.edit', compact('thread'));
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

            dd('Tópico atualizado com sucesso');

        } catch (\Exception $e) {

            dd($e->getMessage());

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

            dd('Tópico removido com sucesso');

        } catch (\Exception $e) {

            dd($e->getMessage());

        }
    }
}
