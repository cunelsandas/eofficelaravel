@extends('layouts.app')
@section('title','List '.ucfirst(config('settings.tags_label_plural')))
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
{{--        <h1 class="pull-left">{{ucfirst(config('settings.tags_label_plural'))}}</h1>--}}
        <h1 class="pull-left" style="font-family: 'Prompt', sans-serif">แท็ก</h1>
        <h1 class="pull-right">
            @can('create tags')
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;font-family: 'Prompt', sans-serif"
                   href="{!! route('tags.create') !!}">
                    <i class="fa fa-plus"></i>
                    เพิ่มแท็กใหม่
                </a>
            @endcan
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('tags.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

