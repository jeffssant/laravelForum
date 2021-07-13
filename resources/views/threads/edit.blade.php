@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>
                Editar Tópico
            </h2>
        </div>
        <div class="col-12">
            <form action="{{route('threads.update', $thread->slug)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control" value="{{$thread->title}}" name="title">
                </div>

                <div class="form-group">
                    <label for="">Conteúdo do Tópico</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$thread->body}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Tópico</button>
            </form>
        </div>
    </div>

@endsection
