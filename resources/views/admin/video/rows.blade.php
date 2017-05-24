@foreach ($videos as $video)
    <tr role="row">
        <th rowspan="1" colspan="1" style="width: 3%">
            <input type="checkbox" class="item-id" value="{{ $video->id }}" />
        </th>
        <td class="_1">{{ $video->name }}</td>
        <td><a href="{{ $video->link }}" target="_blank">{{ $video->link }}</a></td>
        <td width="18%" >{{ $video->description }}</td>
        <td class="center hidden-xs">{{ $video->partner->name }}</td>
        <td class="center hidden-xs sorting" width="16%">{{ $video->formatted_upload_date }}</td>
        <td class="center hidden-xs sorting" width="16%">{{ $video->formatted_updated_at }}</td>
        <td width="10%">
            <a href="{{ route('video_update', $video->id) }}" class="btn btn-sm btn-icon btn-default">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::open(['url' => route('video_delete', $video->id), 'method' => 'delete', 'style' => 'display:inline-block']) !!}
            <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach