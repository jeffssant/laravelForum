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

                <label>Canal</label>
                <select name="channel_id" class="form-control mb-3">
                    @foreach ($channels as $channel)
                        <option value="{{$channel->id}}" class="form-group" @if ($thread->channel_id === $channel->id) selected @endif>{{$channel->name}}</option>
                    @endforeach
                </select>

                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" value="{{$thread->title}} " name="title">
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Conteúdo do Tópico</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$thread->body}}</textarea>
                    @error('body')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Tópico</button>
            </form>
        </div>
    </div>

@endsection
