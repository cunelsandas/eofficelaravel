@extends('layouts.app')
@section('title','Home')
@section('scripts')
    <script>
        function gotoUpload() {
            var docId = $("#document_id").val();
            {{--var urlToUp = '{{route('documents.files.create',['id'=>''])}}'+'/'+docId;--}}
            var urlToUp = '{{route('documents.files.create',['id'=>'/'])}}'+'/'+docId;
            console.log(urlToUp);
            window.location.href = urlToUp;
            return false;
        }
        $(function () {
            $('#activityrange').daterangepicker(
                {
                    ranges   : {
                        // 'Today'       : [moment(), moment()],
                        // 'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        // 'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        // 'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        // 'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]

                        'วันนี้'       : [moment(), moment()],
                        'เมื่อวาน'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 วันที่ผ่านมา' : [moment().subtract(6, 'days'), moment()],
                        '30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
                        'เดือนนี้'  : [moment().startOf('month'), moment().endOf('month')],
                        'เดือนที่แล้ว'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {

                    $('#activityrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                    $('#activity_range').val(start.format('YYYY-MM-DD') + 'to' + end.format('YYYY-MM-DD'));
                }
            );
            @if(request()->has('activity_range'))
                var dates = '{{request('activity_range')}}'.split('to');
                var start = moment(dates[0]);
                var end = moment(dates[1]);
                $('#activityrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
            @endif
        });
    </script>
@stop
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    <section class="content-header">
        <h1 class="pull-left" style="font-family: 'Prompt', sans-serif">หน้าแรก</h1>
    </section>
    <section class="content" style="margin-top: 20px;">
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header no-border text-center">
                        <h3 class="box-title" style="font-family: 'Prompt', sans-serif">ทางลัดอัพโหลด</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="#" class="text-center" style="width: 30vw;margin: 0 auto;" onsubmit="return gotoUpload()">
                            <div class="form-group">
{{--                                <label for="">เลือก {{ucfirst(config('settings.document_label_singular'))}}</label>--}}
                                <label for="">เลือก แฟ้มเอกสาร</label>
                                <select name="document_id" id="document_id" class="form-control select2">
                                    @foreach ($documents as $document)
                                        @can('view',$document)
                                            <option value="{{$document->id}}">{{$document->name}}</option>
                                        @endcan
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">อัพโหลด</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-tags"></i></span>

                    <div class="info-box-content">
{{--                        <span class="info-box-text">{{ucfirst(config('settings.tags_label_plural'))}}</span>--}}
                        <span class="info-box-text">แท็ก</span>
                        <span class="info-box-number">{{$tagCounts}}</span>
                        <span class="progress-description">
{{--                    ทั้งหมด {{$tagCounts}} {{ucfirst(config('settings.tags_label_plural'))}} ในระบบ--}}
                             ทั้งหมด {{$tagCounts}} แท็กในระบบ
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-folder"></i></span>

                    <div class="info-box-content">
{{--                        <span class="info-box-text">{{ucfirst(config('settings.document_label_plural'))}}</span>--}}
                        <span class="info-box-text">โฟล์เดอร์จัดเก็บเอกสาร</span>
                        <span class="info-box-number">{{$documentCounts}} โฟล์เดอร์</span>
                        <span class="progress-description">
{{--                    ทั้งหมด {{$filesCounts}} {{ucfirst(config('settings.file_label_plural'))}} ไฟล์--}}
                             {{$filesCounts}} ไฟล์
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header no-border">
                        <h3 class="box-title"  style="font-family: 'Prompt', sans-serif">กิจกรรมเอกสาร</h3>

                        <div class="box-tools pull-right" >
                            {!! Form::open(['method' => 'get','style'=>'display:inline;']) !!}
                                {!! Form::hidden('activity_range', '', ['id' => 'activity_range']) !!}
                                <button type="button" id="activityrange" class="btn btn-default btn-sm">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span>เลือกวันที่</span> <i class="fa fa-caret-down"></i>
                                </button>
                                {!! Form::button('<i class="fa fa-search"></i>&nbsp;ค้นหา', ['class' => 'btn btn-default btn-sm','type'=>'submit']) !!}
                            {!! Form::close() !!}
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <ul class="timeline">
                            <li class="time-label">
                                <span class="bg-red">{{DateThai2(optional($activities->first())->created_at,'d M Y')}}</span>
                            </li>
                            @foreach ($activities as $activity)
                                @can('view',$activity->document)
                                <li>
                                    @if($activity->createdBy->name == 'Super Admin')
                                    <i class="fa fa-user bg-aqua" data-toggle="tooltip"
                                       title="{{$activity->createdBy->name}}"></i>
                                     @elseif ($activity->createdBy->name =='นายก')
                                        <i class="fa fa-user bg-orange" data-toggle="tooltip"
                                           title="{{$activity->createdBy->name}}"></i>
                                    @else
                                        <i class="fa fa-user bg-green" data-toggle="tooltip"
                                           title="{{$activity->createdBy->name}}"></i>
                                    @endif
                                    <div class="timeline-item">
                                            <span class="time" data-toggle="tooltip"
                                                  title="{{DateThai($activity->created_at)}}"><i
                                                    class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</span>

                                        <h4 class="timeline-header no-border"  style="font-family: 'Prompt', sans-serif">{!! $activity->activity !!}</h4>
                                    </div>
                                </li>
                                @endcan
                            @endforeach
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                        <div class="text-center">
                            {!! $activities->appends(request()->all())->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
