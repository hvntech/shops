@extends('layouts.admin')

@section('page_heading')
    {{ $page->page_name }}
@endsection
@section('content')
    {!! Form::open(['url' => route('page_update'), 'class' => 'form-horizontal', 'files' => true]) !!}
    <input type="hidden" name="id" value="{{ $page->id }}" />
    <input type="hidden" name="type" value="{{ $page->type }}" />
    <div class="form-group">
        <label class="col-sm-2 pull-left" for="description">Page Banner</label>
        <div class="col-sm-10">
            <input type="file" name="banner_file" accept="image/*" />
            @if ($page->banner_url)
                <img src="{{ $page->banner_url }}" class="img-responsive" style="margin-top: 10px" />
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <textarea id="content" name="text">{!! $page->text !!}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-1">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
        <div class="col-sm-1">
            <button type="reset" class="reset-form btn btn-danger">Reset</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('script')
    <script src="{{ asset("assets/ckeditor/ckeditor.js") }}" type="text/javascript"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={!! csrf_token() !!}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={!! csrf_token() !!}'
        };

        CKEDITOR.replace('content', options);

        $(function () {
            $('.reset-form').on('click', function () {
                if (confirm('Do you want to reset this form?')) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
