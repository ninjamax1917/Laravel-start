@extends('layouts.app')

@section('title', 'Главная')

@section('content')
@include('partials.header', ['title' => 'Главная страница'])

    <div class="container mx-auto">
        <h1>
            Добро пожаловать на главную страницу!
        </h1>
    </div>
    
@endsection
