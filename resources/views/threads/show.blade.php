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

                    <small>Criado por: {{$thread->user->name}} há {{$thread->created_at->diffForHumans()}} </small> <br>
                    <span class="badge badge-primary">
                        {{$thread->channel->name}}
                    </span>
                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>

                @can('update', $thread)
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
                @endcan


            </div>
            <hr>
        </div>

        @if ($thread->replies->count())
            <div class="col-12">
                <h5>Respostas</h5>
                <hr>

                @foreach ($thread->replies as $reply )
                    <div class="card mb-3">
                        <div class="card-body">
                            {{$reply->reply}}
                        </div>
                        <div class="card-footer">
                            <small>Respondido por {{$reply->user->name}} há {{$reply->created_at->diffForHumans()}}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @auth
            <div class="col-12">
                <hr>
                <form action="{{route('replies.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="thread_id" value="{{$thread->id}}">
                    <div class="form-group">
                        <label>Responder</label>
                        <textarea name="reply" cols="30" rows="5" class="form-control @error('reply') is-invalid @enderror"></textarea>
                        @error('reply')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary"> Responder</button>
                </form>

            </div>
        @endauth

    </div>

@endsection
