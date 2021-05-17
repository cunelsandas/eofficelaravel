@extends('layouts.app')
@section('title','Direction')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
        <h1 class="pull-left" style="font-family: 'Prompt', sans-serif">หนังสือภายใน</h1>
        <h1 class="pull-right">
            @can('create directions')
                <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px;font-family: 'Prompt', sans-serif"
                   href="{!! route('directions.create') !!}">
                    <i class="fa fa-plus"></i>
                    ทดสอบ
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
              ทดสอบ
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

