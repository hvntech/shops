@extends('layouts.admin')
@section('page_heading')
    News List
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
                            <ul class="nav nav-tabs">
                                <li class="active"><a style="cursor: pointer" href="{{ route('news_lists') }}">News</a></li>
                                <li><a style="cursor: pointer" href="{{ route('news_category_lists') }}">Category</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-3 pull-left">
                                <a href="{{ route('news_create') }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-plus"></i></a>
                                <button type="button" class="btn btn-sm btn-icon btn-danger" id="delete"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th width="3%">
                                            <input type="checkbox" id="selectAll" />
                                        </th>
                                        <th data-sort="name" data-direction="desc">
                                            {{ trans('News\'s Name') }}
                                        </th>
                                        <th data-sort="description">
                                            {{ trans('News Description') }}
                                        </th>
                                        <th data-sort="created_at">
                                            {{ trans('Create Date') }}
                                        </th>
                                        <th data-sort="partner_name">
                                            {{ trans('Partner\'s Name ') }}
                                        </th>
                                        <th data-sort="category_name">
                                            {{ trans('Category') }}
                                        </th>
                                        <th width="10%">
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
                                        <td class="center hidden-xs">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                <input type="text" class="form-control" data-field="created_at" id="created_at">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input partners name" data-field="partner_name">
                                            </div>
                                        </td>
                                        <td class="center hidden-xs ">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Input category name" data-field="news_category_name">
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

        var newsIds = [];

        $('.item-id:checked').each(function(item, data) {
            if ( $(this).is(':checked') ) {
                newsIds[item] = data.value;
            }
        });

        if (newsIds.length == 0) {
            alert('Please select at least a newsIds');
            return;
        }

        if (confirm("Are you sure you want to delete " + newsIds.length + " news\'(s) this?")){
            $.ajax({
                type : 'get',
                url : '{{ route("news_delete_lists") }}',
                data : {
                    newsIds : newsIds
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
        Soccast.searchUrl = '{{ route("news_data") }}';
        Soccast.currentPage = '{{ $page or '' }}';
        Soccast.fields = {!! json_encode($fields) !!};
        Soccast.sorts = {!! json_encode($sorts) !!};
        $("#created_at").datetimepicker({
            format: "DD/MM/Y",
        }).on("dp.change", function (e) {
            if (e.oldDate === null) {
                return;
            }

            $(this).trigger('keyup').data("DateTimePicker").hide();
        });
    </script>
@endsection
