@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Update a video</h3>
        </div>
        <section class="panel panel-default">

            <div class="panel-body">
                {!! Form::open(['url' => route('video_store'), 'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('videoId', $video->id) }}
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="name">{{ trans('Video\'s Name') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" id="name" required="required" placeholder="Enter name" value="@if (old('name')) {{ old('name') }} @else {{ $video->name }} @endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="link">{{ trans('Video\'s URL') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="link" id="link" required="required" placeholder="Enter url" value="@if (old('link')) {{ old('link') }} @else {{ $video->link }} @endif">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">{{ trans('Video\'s Description') }}:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="3" placeholder="Enter description" name="description" cols="50">@if (old('description')) {{ old('description') }} @else {{ $video->description }} @endif</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="Partner">{{ trans('Partner\'s Name') }}:</label>
                        <div class="col-sm-8">
                            <select name="partners_id" class="form-control" style="text-align: center;">
                                <option value="0">All</option>
                                @foreach ($partners as $partner)
                                    @if ($partner->id == old('partners_id'))
                                        <option value="{{ old('partners_id') }}" selected>{{ $partner->name }}</option>
                                    @else
                                        @if ($partner->id == $video->partners_id)
                                        <option value="{{ $partner->id }}" selected>{{ $partner->name }}</option>
                                        @else
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-success">{{ trans('Submit') }}</button>
                            <button type="reset" class="btn btn-danger">{{ trans('Reset') }}</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

        </section>
    </section>
@endsection