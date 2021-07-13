@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12 mb-3">
            <h2>{{$thread->title}}</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-header">

                  <small>Criado por: {{$thread->user->name}} há {{$thread->created_at->diffForHumans()}}</small>

                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>

                <div class="card-footer">

                    <a href="{{route('threads.edit', $thread->slug)}}" class="btn btn-sm btn-primary ">Editar</a>
                    <a  href="#" class="btn btn-sm btn-danger"
                        onclick="event.preventDefault(); document.querySelector('.thread-rm').submit()" >
                        Delete
                    </a>

                    <form action="{{route('threads.destroy', $thread->slug)}}" method="POST" class="thread-rm display-none">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>
            </div>
            <hr>
        </div>
    </div>

@endsection
