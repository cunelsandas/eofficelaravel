@extends('layouts.app')
@section('title','New User')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body,h1{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
        <h1>
           ผู้ใช้งาน
        </h1>
    </section>
    <div class="content">

        {!! Form::open(['route' => 'users.store']) !!}

        @include('users.fields')

        {!! Form::close() !!}
    </div>
@endsection
