@extends('layouts.app')
@section('title',ucfirst(config('settings.document_label_plural'))." List")
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style type="text/css">
        body,h1{
            font-family: 'Prompt', sans-serif;
        }
        .bg-folder-shaper {
            width: 100%;
            height: 115px;
            border-radius: 0px 15px 15px 15px !Important;
        }

        .folder-shape-top {
            width: 57px;
            height: 17px;
            border-radius: 20px 37px 0px 0px;
            position: absolute;
            top: -16px;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .widget-user-2 .widget-user-username, .widget-user-2 .widget-user-desc {
            margin-left: 10px;
            font-weight: 400;
            font-size: 17px;
            font-family: 'Prompt', sans-serif;
        }

        .widget-user-username {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .m-t-20 {
            margin-top: 20px;
        }

        .dropdown-menu {
            min-width: 100%;
        }

        .doc-box.box {
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0.0) !important;
        }

        .bg-folder-shaper:hover {
            background-color: yellow;
        }

        .select2-container {
            width: 100% !important;
        }

        #filterForm.in, filterForm.collapsing {
            display: block !important;
        }
    </style>
@stop
@section('scripts')
    <script>

    </script>
@stop
@section('content')
    <section class="content-header">
        <h1 class="pull-left">
{{--            {{ucfirst(config('settings.document_label_plural'))}}--}}
            แฟ้มเอกสาร
        </h1>
        <h1 class="pull-right" style="font-family: 'Prompt', sans-serif">
            @can('create',\App\Document::class)
                <a href="{{route('documents.create')}}"
                   class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    เพิ่มเอกสารใหม่
                </a>
            @endcan
        </h1>
    </section>
    <div class="content" style="margin-top: 22px;">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="form-group hidden visible-xs">
                    <button type="button" class="btn btn-default btn-block" data-toggle="collapse"
                            data-target="#filterForm"><i class="fa fa-search"></i> ค้นหา
                    </button>
                </div>
                {!! Form::model(request()->all(), ['method'=>'get','class'=>'form-inline visible hidden-xs','id'=>'filterForm']) !!}
                <div class="form-group">
                    <label for="search" class="sr-only">Search</label>
                    {!! Form::text('search',null,['class'=>'form-control input-sm','placeholder'=>'ชื่อเอกสาร...']) !!}
                </div>
                <div class="form-group">
                    <label for="tags" class="sr-only">{{config('settings.tags_label_singular')}}:</label>
                    <select class="form-control select2 input-sm" name="tags[]" id="tags"
                            data-placeholder="เลือก {{config('settings.tags_label_singular')}}" multiple>
                        @foreach($tags as $tag)
                            @canany(['read documents','read documents in tag '.$tag->id])
                                <option
                                    value="{{$tag->id}}" {{in_array($tag->id,request('tags',[]))?'selected':''}}>{{$tag->name}}</option>
                            @endcanany
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="sr-only">{{config('settings.tags_label_singular')}}:</label>
                    {!! Form::select('status',['0'=>"ALL",config('constants.STATUS.PENDING')=>config('constants.STATUS.PENDING'),config('constants.STATUS.APPROVED')=>config('constants.STATUS.APPROVED'),config('constants.STATUS.REJECT')=>config('constants.STATUS.REJECT')],null,['class'=>'form-control input-sm']) !!}
                </div>
                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> ค้นหา</button>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                <div class="row">
                    @foreach ($documents as $document)
                        @cannot('view',$document)
                            @continue
                        @endcannot
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 m-t-20" style="cursor:pointer;">
                            <div class="doc-box box box-widget widget-user-2">
                                <div class="widget-user-header bg-gray bg-folder-shaper no-padding">
                                    <div class="folder-shape-top bg-gray"></div>
                                    <div class="box-header">
                                        <a href="{{route('documents.show',$document->id)}}" style="color: black;">
                                            <h3 class="box-title"><i class="fa fa-folder text-yellow"></i></h3>
                                        </a>

                                        <div class="box-tools pull-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"
                                                        style="    background: transparent;border: none;">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                                    <li><a href="{{route('documents.show',$document->id)}}">แสดง</a>
                                                    </li>
                                                    @can('edit',$document)
                                                        <li><a href="{{route('documents.edit',$document->id)}}">แก้ไข</a>
                                                        </li>
                                                    @endcan
                                                    @can('delete',$document)
                                                        <li>
                                                            {!! Form::open(['route' => ['documents.destroy', $document->id], 'method' => 'delete']) !!}
                                                            {!! Form::button('ลบ', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-link',
                                                                        'onclick' => "return conformDel(this,event)"
                                                                    ]) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    @endcan

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <a href="{{route('documents.show',$document->id)}}" style="color: black;">
                                    <span style="max-lines: 1; white-space: nowrap;margin-left: 3px;">
                                    @foreach ($document->tags as $tag)
                                            <small class="label"
                                                   style="background-color: {{$tag->color}};font-size: 0.93rem;">{{$tag->name}}</small>
                                        @endforeach
                                    </span>
                                        <h5 class="widget-user-username" title="{{$document->name}}"
                                            data-toggle="tooltip">{{$document->name}}</h5>
                                        <h5 class="widget-user-desc" style="font-size: 12px"><span data-toggle="tooltip"
                                                                                                   title="{{formatDateTime($document->updated_at)}}">{{formatDate($document->updated_at)}}</span>
                                            <span
                                                class="pull-right" style="margin-right: 15px;">
                                            {!! $document->isVerified ? '<i title="อนุมัติเอกสาร" data-toggle="tooltip" class="fa fa-check-circle" style="color: #388E3C;"></i>':'<i title="ยังไม่อนุมัติเอกสาร" data-toggle="tooltip" class="fa fa-remove" style="color: #f44336;"></i>' !!}
                                        </span></h5>
                                    </a>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                {!! $documents->appends(request()->all())->render() !!}
            </div>
        </div>
    </div>
@endsection
