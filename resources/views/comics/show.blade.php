@extends('layouts.base')

@section('documentTitle')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $comic->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img class="fluid-img" src=" {{ $comic->thumb }}" alt="{{ $comic->title }}">
            </div>
            <div class="col">
                <div>{{ $comic->description }}</div>
                <div>
                    <h2>{{ $comic->price }} €</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
