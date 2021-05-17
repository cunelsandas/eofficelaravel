<!-- Name Field -->
<div class="form-group col-sm-6 {{ $errors->has('email') ? 'has-error' :'' }}">
    {!! Form::label('name', 'ชื่อเอกสาร:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name','<span class="help-block">:message</span>') !!}
</div>
{{--if in edit mode--}}
@if ($document)
    @if (auth()->user()->can('update document '.$document->id) && !auth()->user()->is_super_admin)
        @foreach($document->tags->pluck('id')->toArray() as $tagId)
            <input type="hidden" name="tags[]" value="{{$tagId}}">
        @endforeach
    @else
        <div class="form-group col-sm-6 ">
            <label for="tags[]">{{ucfirst(config('settings.tags_label_plural'))}}</label>
            <select class="form-control select2" id="tags"
                    name="tags[]"
                    multiple>
                @foreach($tags as $tag)
                    @canany (['update documents','update documents in tag '.$tag->id])
                        <option
                            value="{{$tag->id}}" {{(in_array($tag->id,old('tags', optional(optional(optional($document)->tags)->pluck('id'))->toArray() ?? [] )))?"selected":"" }}>{{$tag->name}}</option>
                    @endcanany
                @endforeach
            </select>
        </div>
    @endif
@else
    <div class="form-group col-sm-6 {{ $errors->has("tags") ? 'has-error' :'' }}">
        <label for="tags[]">{{ucfirst(config('settings.tags_label_plural'))}}</label>
        <select class="form-control select2" id="tags" name="tags[]" multiple>
            @foreach($tags as $tag)
                @canany (['create documents','create documents in tag '.$tag->id])
                    <option
                        value="{{$tag->id}}" {{(in_array($tag->id,old('tags', optional(optional(optional($document)->tags)->pluck('id'))->toArray() ?? [] )))?"selected":"" }}>{{$tag->name}}</option>
                @endcanany
            @endforeach
        </select>
        {!! $errors->first("tags",'<span class="help-block">:message</span>') !!}
    </div>
@endif
<!-- c_recieveno Field -->
<div class="form-group col-sm-6 {{ $errors->has('c_recieveno') ? 'has-error' :'' }}">
    {!! Form::label('c_recieveno', 'เลขที่รับ:') !!}
    {!! Form::text('c_recieveno', null, ['class' => 'form-control']) !!}
    {!! $errors->first('c_recieveno','<span class="help-block">:message</span>') !!}
</div>



<!-- c_recieve_date Field -->
<div class="form-group col-sm-6 {{ $errors->has('c_recieve_date') ? 'has-error' :'' }}">
    {!! Form::label('c_recieve_date', 'วันที่รับ:') !!}
    {!! Form::date('c_recieve_date', null, ['class' => 'form-control']) !!}
    {!! $errors->first('c_recieve_date','<span class="help-block">:message</span>') !!}
</div>


<!-- c_recieve_date -->
<div class="form-group col-sm-6 {{ $errors->has('docdate') ? 'has-error' :'' }}">
    {!! Form::label('docdate', 'วันที่เอกสาร:') !!}
    {!! Form::date('docdate', null, ['class' => 'form-control']) !!}
    {!! $errors->first('docdate','<span class="help-block">:message</span>') !!}
</div>

{!! Form::bsTextarea('description',null,['class'=>'form-control b-wysihtml5-editor']) !!}


{{--additional Attributes--}}
@foreach ($customFields as $customField)
    <div class="form-group col-sm-6 {{ $errors->has("custom_fields.$customField->name") ? 'has-error' :'' }}">
        {!! Form::label("custom_fields[$customField->name]", Str::title(str_replace('_',' ',$customField->name)).":") !!}
        {!! Form::text("custom_fields[$customField->name]", null, ['class' => 'form-control typeahead','data-source'=>json_encode($customField->suggestions),'autocomplete'=>is_array($customField->suggestions)?'off':'on']) !!}
        {!! $errors->first("custom_fields.$customField->name",'<span class="help-block">:message</span>') !!}
    </div>
@endforeach
{{--end additional attributes--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('บันทึก', ['class' => 'btn btn-success']) !!}
    {!! Form::submit('บันทึก & อัปโหลด', ['class' => 'btn btn-success','name'=>'savnup']) !!}
    <a href="{!! route('documents.index') !!}" class="btn btn-warning">ยกเลิก</a>
</div>
