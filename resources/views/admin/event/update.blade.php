@extends('layouts.admin')
@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Add a event</h3>
        </div>
        <section class="panel panel-default">

            <div class="panel-body">
                {!! Form::open(['url' => route('event_store'), 'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('eventId', $event->id) }}
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="name">{{ trans('Event\'s Name') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="@if (old('name')) {{ old('name') }} @else {{ $event->name }} @endif" name="name" id="name" required="required" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">{{ trans('Event\'s Description') }}:</label>
                        <div class="col-sm-9">
                            <textarea placeholder="Enter description" class="form-control" rows="3" name="description" cols="50">@if (old('description')) {{ old('description') }} @else {{ $event->description }} @endif</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="notes">{{ trans('Important Notes') }}:</label>
                        <div class="col-sm-9">
                            <textarea placeholder="Enter notes" class="form-control" rows="3" name="notes" cols="50">@if (old('notes')) {{ old('notes') }} @else {{ $event->notes }} @endif</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event date">{{ trans('Event\'s Date and Time') }}:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                <input type="text" class="form-control" value="{{ \Helper::carbonToDisplayDateStr($event->datetime) }}" placeholder="Enter date" name="datetime" id="datetime">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event location">{{ trans('Event\'s Address') }}:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-location-arrow"></span></span>
                                <input type="text" placeholder="Enter address" class="form-control" value="@if (old('location')) {{ old('location') }} @else {{ $event->location }} @endif" name="location">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event fee">{{ trans('Event\'s Fee') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="Enter fee" class="form-control" name="fee" required="required" value="@if (old('fee')) {{ old('fee') }} @else {{ $event->fee }} @endif" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event partner">{{ trans('Partner\'s Name') }}:</label>
                        <div class="col-sm-9">
                            <select name="partners_id" class="form-control" style="text-align: center;">
                                <option value="0">All</option>
                                @foreach ($partners as $partner)
                                    @if ($partner->id == old('partners_id'))
                                        <option value="{{ old('partners_id') }}" selected>{{ $partner->name }}</option>
                                    @else
                                        @if ($partner->id == $event->partners_id)
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
@section('script')
    <script>
        $("#datetime").datetimepicker({
            format: "DD/MM/Y H:mm",
            minDate: $.now()
        });
    </script>
@endsection