@extends('layouts.admin')
@section('page_heading')
    Event List
@endsection
@section('content')

    <!-- /.row -->
    <div class="row event-lists">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="panel-body">
                            <div class="pull-right">
                                <div class="pull-right">
                                    <a href="{{ route('event_create') }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-plus"></i></a>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" id="delete"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 3%" class="">
                                            <input type="checkbox" id="selectAll" />
                                        </th>
                                        <th rowspan="1" colspan="1" data-sort="name" data-direction="asc" class="">
                                            {{ trans('Event Name') }}
                                        </th>
                                        <th rowspan="1" width="18%" colspan="1" data-sort="description" class="hidden-xs ">
                                            {{ trans('Brief Description') }}
                                        </th>
                                        <th rowspan="1" colspan="1" width="15%" data-sort="datetime" class="hidden-xs ">
                                            {{ trans('Event Date And Time') }}
                                        </th>
                                        <th rowspan="1" colspan="1" width="8%" data-sort="location" class="hidden-xs ">
                                            {{ trans('Event Address ') }}
                                        </th>
                                        <th rowspan="1" colspan="1" class="hidden-xs " data-sort="fee">
                                            {{ trans('Event Fee ') }}
                                        </th>
                                        <th rowspan="1" colspan="1" width="10%" data-sort="notes" class="hidden-xs ">
                                            {{ trans('Important Notes') }}
                                        </th>
                                        <th rowspan="1" colspan="1" class="hidden-xs " data-sort="number_joined">
                                            {{ trans('No.of Person Joined') }}
                                        </th>
                                        <th rowspan="1" colspan="1" width="8%" class="hidden-xs " data-sort="partner_name">
                                            {{ trans('Partner Name') }}
                                        </th>
                                        <th rowspan="1" colspan="1" class="hidden-xs " data-sort="upcomming">
                                            {{ trans('Status') }}
                                        </th>
                                        <th rowspan="1" colspan="1" width="10%">
                                            {{ trans('Action') }}
                                        </th>
                                    </tr>
                                    <tr role="row">
                                        <th>&nbsp;</th>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input name" data-field="name">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input description" data-field="description">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                <input type="text" class="form-control" placeholder="Input date" data-field="datetime" id="datetime">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input event address" data-field="location">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input fee" data-field="fee">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="notes" data-field="notes">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input number of joined" data-field="number_joined">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input partner name" data-field="partner_name">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <select data-field="status" class="form-control" style="text-align: center;">
                                                    <option value="">All</option>
                                                    <option value="1">Upcoming</option>
                                                    <option value="2">Pass</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="center">
                                        </td>
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
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('#delete').click(function() {
        var eventIds = [];

        $('.item-id:checked').each(function(item, data) {
            if ( $(this).is(':checked') ) {
                eventIds[item] = data.value;
            }
        });

        if (eventIds.length == 0) {
            alert('Please select at least a event');
            return;
        }

        if (confirm("Are you sure you want to delete " + eventIds.length + " event(s) this?")){
            $.ajax({
                type : 'get',
                url : '{{ route("event_delete_lists") }}',
                data : {
                    eventIds : eventIds
                },
                success : function(response) {
                    if (response.status) {
                        alert('{{ trans( "message.success") }}');
                        location.reload();
                    } else {
                        alert('{{ trans( "message.deleted") }}');
                        location.reload();
                    }
                }
            });
        }
    });
</script>
<script>
    var Soccast = Soccast || {};

    Soccast.searchList = true;
    Soccast.searchUrl = '{{ route("event_data") }}';
    Soccast.currentPage = '{{ $page or '' }}';
    Soccast.fields = {!! json_encode($fields) !!};
    Soccast.sorts = {!! json_encode($sorts) !!};
//    Soccast.multipleSort = true; // Uncomment to sort by many columns

    $("#datetime").datetimepicker({
        format: "DD/MM/Y",
    }).on("dp.change", function (e) {
        if (e.oldDate === null) {
            return;
        }

        $(this).trigger('keyup').data("DateTimePicker").hide();
    });
</script>
@endsection