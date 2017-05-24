@foreach ($users as $user)
    <tr>
        <td width="27px"><input type="checkbox" class="row-checkbox" data-user-id="{{ $user->id }}" value="{{ $user->id }}"></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->mobile_phone }}</td>
        <td>{{ $user->formatted_created_at }}</td>
        <td class="center">
            <a href="{{ route('user_view', $user->id) }}" class="btn btn-sm btn-icon btn-default">
                <i class="fa fa-info-circle"></i>
            </a>
            <a href="{{ route('user_show_update', $user->id) }}" class="btn btn-sm btn-icon btn-default">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::open(['url' => route('user_delete'), 'method' => 'post', 'style' => 'display:inline-block']) !!}
            <input type="hidden" value="{{ $user->id }}" name="ids">
            <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach