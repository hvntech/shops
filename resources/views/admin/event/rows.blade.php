@foreach ($events as $event)
    <tr role="row">
        <th rowspan="1" colspan="1" style="width: 3%">
            <input type="checkbox" class="item-id" value="{{ $event->id }}" />
        </th>
        <td class="_1">
            <div class="wrap">{{ $event->name }}</div>
        </td>
        <td width="18%">
            <div class="wrap">{{ $event->description }}</div>
        </td>
        <td class="center hidden-xs " width="15%" >
            <div class="wrap">{{ $event->formatted_datetime }}</div>
        </td>
        <td class="center hidden-xs " width="8%">
            <div class="wrap">{{ $event->location }}</div>
        </td>
        <td class="center hidden-xs sorting">
            <div class="wrap">{{ \Helper::currencyFormat($event->fee) }}</div>
        </td>
        <td class="center hidden-xs sorting" width="10%">
            <div class="wrap">{{ $event->notes }}</div>
        </td>
        <td class="center hidden-xs sorting"><a class="wrap">{{ $event->countJoinedUsers() }}</a></td>
        <td class="center hidden-xs sorting" width="8%">
            <div class="wrap">{{ $event->partner_name }}</div>
        </td>
        <td class="center hidden-xs sorting">
            <div class="wrap">
                @if ($event->datetime->gte(\Helper::dateSqlToDateTime(\Carbon\Carbon::now())))
                    {{ trans('Upcomming') }}
                @else
                    {{ trans('Pass') }}
                @endif
            </div>
        </div>
        </td>
        <td class="center" width="10%">
            <a href="{{ route('event_update', $event->id) }}" class="btn btn-sm btn-icon btn-default">
                <i class="fa fa-edit"></i>
            </a>
            {!! Form::open(['url' => route('event_delete', $event->id), 'method' => 'delete', 'style' => 'display:inline-block']) !!}
            <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
                <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
        </td>
    </tr>
@endforeach