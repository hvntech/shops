@extends('layouts.admin')

@section('content')
    <section class="scrollable padder">
        <a href="#" class="btn btn-info" id="back">Back</a>
        <div class="m-b-md">
            <h3 class="m-b-none">View a user</h3>
        </div>
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">Email:</label>
                        <div class="col-sm-9">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="name">Name:</label>
                        <div class="col-sm-9">
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">Mobile phone:</label>
                        <div class="col-sm-9">
                            {{ $user->mobile_phone }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 pull-left" for="description">Register date:</label>
                        <div class="col-sm-9">
                            {{ $user->formatted_created_at }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('script')
    <script>
        $('#back').on('click', function (e) {
            e.preventDefault();
            window.history.back();
        });
    </script>
@endsection
