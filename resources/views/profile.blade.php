<link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
<style>
    body h1{
        font-family: 'Prompt', sans-serif;
    }
</style>
@extends('layouts.app')
@section('title','Profile')
@section('scripts')
    <script>
        $(function () {
            var url = document.location.toString();
            if (url.match('#')) {
                $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
            }
            $('.nav-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });
        });
    </script>
@stop
@section('content')
    <section class="content-header" style="margin-bottom: 25px;">
        <h1 class="pull-left">
            โปรไฟล์
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">โปรไฟล์</a></li>
                        <li class=""><a href="#ch_pwd" data-toggle="tab" aria-expanded="false">เปลี่ยนรหัสผ่าน</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            {!! Form::model($profile,['class'=>'form-horizontal']) !!}
                            <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                {!! Form::label('name', 'ชื่อ:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first("name",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                {!! Form::label('email', 'Email:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first("email",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('username')?'has-error':''}}">
                                {!! Form::label('username', 'Username:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first("username",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('address')?'has-error':''}}">
                                {!! Form::label('address', 'ที่อยู่:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first("address",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('description')?'has-error':''}}">
                                {!! Form::label('description', 'รายละเอียด(ข้อมูลอื่น ๆ):', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::textarea('description', null, ['class' => 'form-control b-wysihtml5-editor']) !!}
                                    {!! $errors->first("description",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-success" value="btnprofile" name="btnprofile">
                                        อัพเดทโปรไฟล์
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="tab-pane" id="ch_pwd">
                            {!! Form::model($profile,['class'=>'form-horizontal']) !!}
                            <div class="form-group {{$errors->has('old_password')?'has-error':''}}">
                                {!! Form::label('old_password', 'รหัสผ่านเดิม:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('old_password', ['class' => 'form-control']) !!}
                                    {!! $errors->first("old_password",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('new_password')?'has-error':''}}">
                                {!! Form::label('new_password', 'รหัสผ่านใหม่:', ['class' => 'control-label col-sm-2']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('new_password', ['class' => 'form-control']) !!}
                                    {!! $errors->first("new_password",'<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-success" value="btnpass" name="btnpass">
                                      เปลี่ยนรหัสผ่าน
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
