@foreach ($news as $new)
    <tr role="row">
        <th width="3%">
            <input type="checkbox" class="item-id" value="{{ $new->id }}" />
        </th>
        <td>{{ $new->name }}</td>
        <td>{{ $new->description }}</td>
        <td>{{ $new->formatted_created_at }}</td>
        <td>{{ $new->partner_name }}</td>
        <td>{{ $new->category_name }}</td>
        <td width="10%">
            <a href="{{ route('news_update', $new->id) }}" class="btn btn-sm btn-icon btn-default">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::open(['url' => route('news_delete', $new->id), 'method' => 'delete', 'style' => 'display:inline-block']) !!}
            <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach