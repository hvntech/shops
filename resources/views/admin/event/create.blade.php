@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Add a Event</h3>
        </div>
        <section class="panel panel-default">

            <div class="panel-body">
                {!! Form::open(['url' => route('event_store'), 'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('partners_id', '1') }}
                    {{ Form::hidden('category_id', '1') }}
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="name">{{ trans('Event\'s Name') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="Enter name" class="form-control" name="name" id="name" required="required" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">{{ trans('Event\'s Description') }}:</label>
                        <div class="col-sm-9">
                            <textarea required class="form-control" placeholder="Enter description" rows="3" name="description" cols="50">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="notes">{{ trans('Important Notes') }}:</label>
                        <div class="col-sm-9">
                            <textarea required placeholder="Enter notes" class="form-control" rows="3" name="notes" cols="50">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event date">{{ trans('Event\'s Date and Time') }}:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                <input type="text" placeholder="Enter date" class="form-control" name="datetime" id="datetime" value="{{ old('datetime') }}">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event date">{{ trans('Event\'s Address') }}:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-location-arrow"></span></span>
                                <input type="text" placeholder="Enter address" class="form-control" name="location" required="required" value="{{ old('location') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event date">{{ trans('Event\'s Fee') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="Enter fee" class="form-control" name="fee" value="{{ old('fee') }}" required="required" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="event date">{{ trans('Partner\'s Name') }}:</label>
                        <div class="col-sm-9">
                            <select name="partners_id" class="form-control" style="text-align: center;">
                                <option value="0">None</option>
                                @foreach ($partners as $partner)
                                    @if (old('partners_id'))
                                    <option value="{{ old('partners_id') }}" selected>{{ $partner->name }}</option>
                                    @else
                                    <option value="{{ $partner->id }}">{{ $partner->name }}</option>
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
