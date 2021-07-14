@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>
               Criar Tópico
            </h2>
        </div>
        <div class="col-12">
            <form action="{{route('threads.store')}}" method="POST">
                @csrf
                <label>Canal</label>
                <select name="channel_id" class="form-control mb-3">
                    @foreach ($channels as $channel)
                        <option value="{{$channel->id}}" class="form-group">{{$channel->name}}</option>
                    @endforeach
                </select>

                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control" value="" name="title">
                </div>

                <div class="form-group">
                    <label for="">Conteúdo do Tópico</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Criar Tópico</button>
            </form>
        </div>
    </div>

@endsection
