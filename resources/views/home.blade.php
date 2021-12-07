@extends('layouts.main_layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h3>TODO LIST</h3>
            <hr>
            <div class="my-2">
                <a href="{{route('new_task')}}" class="btn btn-primary">Create task...</a>
            </div>
            <hr>

            @if ($tasks->count() === 0)
                <p>Não existem tarefas disponíveis</p>
            @else
                <p>Ok!!!</p>
            @endif
        </div>
    </div>
</div>
@endsection
