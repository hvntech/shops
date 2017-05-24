@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">Update a Category</h3>
        </div>
        <section class="panel panel-default">

            <div class="panel-body">
                {!! Form::open(['url' => route('news_category_store'), 'class' => 'form-horizontal']) !!}
                    {{ Form::hidden('newsCategoryId', $newsCategory->id) }}
                    <div class="form-group">
                        <label class="col-md-9" for="name">{{ trans('Category Name') }}:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="category_name" required="required" placeholder="Enter name" value="@if (old('category_name')) {{ old('category_name') }} @else {{ $newsCategory->category_name }} @endif">
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