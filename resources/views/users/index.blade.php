@extends('layouts.app')
@section('title','Users List')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
        <h1 class="pull-left" style="font-family: 'Prompt', sans-serif">ผู้ใช้งานระบบ</h1>
        <h1 class="pull-right">
            @can('create users')
                <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px;font-family: 'Prompt', sans-serif"
                   href="{!! route('users.create') !!}">
                    <i class="fa fa-plus"></i>
                    เพิ่มผู้ใช้งาน
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
                @include('users.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

