@extends('layouts.admin')
@section('page_heading')
    Video List
@endsection
@section('content')

    <!-- /.row -->
    <div class="row video-lists">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="panel-body">
                            <div class="col-md-3 pull-right">
                                <div class="pull-right">
                                    <a href="{{ route('video_create') }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-plus"></i></a>
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
                                        <th rowspan="1" colspan="1" width="3%">
                                            <input type="checkbox" id="selectAll" />
                                        </th>
                                        <th rowspan="1" colspan="1" data-sort="name" data-direction="asc">
                                            {{ trans('Video\'s Name') }}
                                        </th>
                                        <th rowspan="1" colspan="1" data-sort="link" class="hidden-xs " data-field="link">
                                            {{ trans('Video\'s URL') }}
                                        </th>
                                        <th rowspan="1" data-sort="description" colspan="1" width="18%" class="hidden-xs " data-field="description">
                                            {{ trans('Brief Description') }}
                                        </th>
                                        <th rowspan="1" data-sort="partner_name" colspan="1" class="hidden-xs " data-field="partners_id">
                                            {{ trans('Partner\'s Name ') }}
                                        </th>
                                        <th rowspan="1" colspan="1" class="hidden-xs " width="16%" data-sort="upload_date" data-field="upload_date">
                                            {{ trans('Upload Date') }}
                                        </th>
                                        <th rowspan="1" colspan="1" data-sort="updated_at" class="hidden-xs " width="16%" data-field="updated_at">
                                            {{ trans('Updated Time') }}
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
                                                <input type="text" class="form-control" placeholder="Input link" data-field="link">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input description" data-field="description">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input partners name" data-field="partner_name">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                <input type="text" class="form-control" data-field="upload_date" id="upload_date">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                <input type="text" class="form-control" data-field="updated_at" id="updated_at">
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

        var videoIds = [];

        $('.item-id:checked').each(function(item, data) {
            if ( $(this).is(':checked') ) {
                videoIds[item] = data.value;
            }
        });

        if (videoIds.length == 0) {
            alert('Please select at least a video');
            return;
        }

        if (confirm("Are you sure you want to delete " + videoIds.length + " video(s) this?")){
            $.ajax({
                type : 'get',
                url : '{{ route("video_delete_lists") }}',
                data : {
                    videoIds : videoIds
                },
                success : function(response) {
                    console.log(response);
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
    Soccast.searchUrl = '{{ route("video_data") }}';
    Soccast.currentPage = '{{ $page or '' }}';
    Soccast.fields = {!! json_encode($fields) !!};
    Soccast.sorts = {!! json_encode($sorts) !!};

    $("#upload_date, #updated_at").datetimepicker({
        format: "DD/MM/Y",
    }).on("dp.change", function (e) {
        if (e.oldDate === null) {
            return;
        }

        $(this).trigger('keyup').data("DateTimePicker").hide();
    });
</script>
@endsection