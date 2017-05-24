@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Add a New</h3>
        </div>
        <section class="panel panel-default">

            <div class="panel-body">
                {!! Form::open(['url' => route('news_store'), 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="name">{{ trans('New\'s Name') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" id="name" required="required" placeholder="Enter name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="link">{{ trans('New\'s Banner Upload') }}:</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="banner_upload" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">{{ trans('Brief Description') }}:</label>
                        <div class="col-sm-9">
                            <textarea placeholder="Enter full brief description" class="form-control" rows="3" name="description" cols="50">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="Partner">{{ trans('Partner\'s Name') }}:</label>
                        <div class="col-sm-8">
                            <select name="partner_id" class="form-control" style="text-align: center;">
                                <option value="0">All</option>
                                @foreach ($partners as $partner)
                                    @if (old('partner_id'))
                                    <option value="{{ old('partner_id') }}" selected>{{ $partner->name }}</option>
                                    @else
                                    <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="Partner">{{ trans('Category\'s Name') }}:</label>
                        <div class="col-sm-8">
                            <select name="news_categories_id" class="form-control" style="text-align: center;">
                                <option value="0">All</option>
                                @foreach ($categories as $category)
                                    @if (old('news_categories_id'))
                                    <option value="{{ old('news_categories_id') }}" selected>{{ $category->category_name }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
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