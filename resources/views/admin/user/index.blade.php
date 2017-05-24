@extends('layouts.admin')
@section('page_heading')
    User List
@endsection
@section('content')
    <div class="row">
        <div class="panel-body">
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{ route('user_create') }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-plus"></i></a>
                    <button type="button" class="btn btn-sm btn-icon btn-danger" id="delete"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>
    </div>
    <table width="100%" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th width="27px"><input type="checkbox" id="check-all" /></th>
            <th data-sort="email">Email</th>
            <th data-sort="name">Name</th>
            <th data-sort="mobile_phone">Mobile Phone</th>
            <th data-sort="created_at">Register Date</th>
            <th>Action</th>
        </tr>
        <tr>
            <td></td>
            <td><input type="text" class="form-control" data-field="email"></td>
            <td><input type="text" class="form-control" data-field="name"></td>
            <td><input type="text" class="form-control" data-field="mobile_phone"></td>
            <td>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                    <input type="text" class="form-control" placeholder="" data-field="created_at" id="datetime">
                </div>
            </td>
            <td></td>
        </tr>
        </thead>
    </table>
    <div class="template-wrapper">
        <table id="rows" class="table table-striped table-bordered table-hover">
        </table>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-6">
            <nav aria-label="Page navigation" class="text-right" id="pagination">

            </nav>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var Soccast = Soccast || {};

        Soccast.searchList = true;
        Soccast.searchUrl = '{{ $searchUrl }}';
        Soccast.currentPage = {{ $page }};
        Soccast.fields = {!! json_encode($fields) !!};
        Soccast.sorts = {!! json_encode($sorts) !!};

        $("#datetime").datetimepicker({
            format: 'DD/MM/YYYY'
        }).on("dp.change", function (e) {
            if (e.oldDate === null) {
                return;
            }

            $(this).trigger('keyup').data("DateTimePicker").hide();
        });

        $('.input-group-addon').on('click', function () {
            $('#datetime').focus();
        });

        $('#delete').on('click', function () {
            var userIds = [];
            $('.row-checkbox').each(function () {
                if ($(this).prop('checked')) {
                    userIds.push($(this).data('user-id'));
                }
            });

            if (!confirm('Are you sure you want to delete ' + userIds.length +' user(s) this?')) {
                return false;
            }

            $.ajax({
                type : 'POST',
                url : '{{ route("user_delete") }}',
                data : {
                    ids: userIds,
                    _token: '{{ csrf_token() }}'
                },
                success : function(response) {
                    if (response.success) {
                        alert('{{ trans( "message.success") }}');
                        location.reload();
                    } else {
                        alert('{{ trans( "message.failure") }}');
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection
