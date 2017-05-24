@foreach ($newsCategories as $newsCategory)
    <tr role="row">
        <th width="3%">
            <input type="checkbox" class="item-id" value="{{ $newsCategory->id }}" />
        </th>
        <td>{{ $newsCategory->category_name }}</td>
        <td>{{ $newsCategory->formatted_created_at }}</td>
        <td width="10%">
            <a href="{{ route('news_category_update', $newsCategory->id) }}" class="btn btn-sm btn-icon btn-default">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::open(['url' => route('news_category_delete', $newsCategory->id), 'method' => 'delete', 'style' => 'display:inline-block']) !!}
            <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach