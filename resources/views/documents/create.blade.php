@extends('layouts.app')
@section('title',"Add ".ucfirst(config('settings.document_label_singular')))
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body,h1{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
        <h1>
           เพิ่มเอกสาร
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'documents.store']) !!}
                        @include('documents.fields',['document'=>null])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
