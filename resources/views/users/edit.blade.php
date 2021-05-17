@extends('layouts.app')
@section('title','Edit User')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body ,h1{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
        <h1>
            แก้ไขผู้ใช้งาน
        </h1>
    </section>
    <div class="content">
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

        @include('users.fields')

        {!! Form::close() !!}
    </div>
@endsection
