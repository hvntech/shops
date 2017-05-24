<?php

namespace App\Services\Production;

use App\Models\AdminUser;
use App\Services\Interfaces\EventServiceInterface;
use App\Models\Event;
use DB;
use Carbon\Carbon;

class EventService extends BaseService implements EventServiceInterface
{
    public function add($dataRequest)
    {
        $event = new Event;
        $event->name = $dataRequest['name'];
        $event->description = $dataRequest['description'];
        $event->notes = $dataRequest['notes'];
        $event->datetime = \Helper::datetimepickerToCarbon($dataRequest['datetime']);
        $event->location = $dataRequest['location'];
        $event->fee = $dataRequest['fee'];
        $event->partners_id = $dataRequest['partners_id'];
        $event->event_banner = 'default'; // todo
        $event->created_by = AdminUser::all()->random()->id; //  todo
        $event->delete_flag = 0;

        return $event->save();
    }

    public function getEventById($eventId)
    {
        return Event::findOrFail($eventId);
    }

    public function getEventLists($requestData)
    {
        $query = Event::select('events.id', 'events.partners_id', 'events.name', 'events.description', 'events.location', 'events.datetime', 'events.fee', 'events.notes', 'partners.name as partner_name', DB::raw('(select count(*) from user_event_registrations where events.id = user_event_registrations.events_id) as user_event_registration_count'))
            ->join('partners', 'events.partners_id', 'partners.id');

        if (isset($requestData['fields']['name'])) {
            $query->where('events.name', 'like', '%' . $requestData['fields']['name'] . '%');
        }

        if (isset($requestData['fields']['description'])) {
            $query->where('events.description', 'like', '%' .  $requestData['fields']['description'] . '%');
        }

        if (isset($requestData['fields']['datetime'])) {
            $query->whereDate('events.datetime', '=', \Helper::datepickerToDateStr($requestData['fields']['datetime']));
        }

        if (isset($requestData['fields']['location'])) {
            $query->where('events.location', 'like', '%' . $requestData['fields']['location'] . '%');
        }

        if (isset($requestData['fields']['fee'])) {
            $query->where('events.fee', '=', $requestData['fields']['fee']);
        }

        if (isset($requestData['fields']['notes'])) {
            $query->where('events.notes', 'like', '%' . $requestData['fields']['notes'] . '%');
        }

        if (isset($requestData['fields']['partner_name'])) {
            $query->where('partners.name', 'like', '%' . $requestData['fields']['partner_name'] . '%');
        }

        if (isset($requestData['fields']['status']) && $requestData['fields']['status'] == 1) {
            $query->where('events.datetime', '>=', Carbon::now());
        } elseif (isset($requestData['fields']['status']) && $requestData['fields']['status'] == 2) {
            $query->where('events.datetime', '<', Carbon::now());
        }

        if (isset($requestData['fields']['number_joined'])) {
            $query->whereRaw('(select count(id) from user_event_registrations where user_event_registrations.events_id = events.id) = ' . $requestData['fields']['number_joined']);
        }

        $query->where('events.delete_flag', 0);

        if (isset($requestData['sorts'])) {
            foreach($requestData['sorts'] as $field => $sort) {
                if ($field == 'partner_name') {
                    $query->orderby('partners.name', $sort);
                } elseif ($field == 'upcomming') {
                    $query->orderBy('events.datetime', $sort);
                } elseif ($field == 'number_joined') {
                    $query->orderBy('user_event_registration_count', $sort);
                } else {
                    $query->orderby('events.' . $field, $sort);
                }
            }
        }

        $events = $query->paginate(Event::PERPAGE);
        return $events;
    }

    public function update($dataRequest)
    {
        $event = Event::where('id', '=', $dataRequest['eventId'])->firstOrFail();
        $event->name = $dataRequest['name'];
        $event->description = $dataRequest['description'];
        $event->notes = $dataRequest['notes'];
        $event->datetime = \Helper::datetimepickerToCarbon($dataRequest['datetime']);
        $event->location = $dataRequest['location'];
        $event->fee = $dataRequest['fee'];
        $event->partners_id = $dataRequest['partners_id'];
        $event->event_banner = 'default'; // todo

        return $event->save();
    }

    public function delete($eventIds)
    {
        if (!is_array($eventIds)) {
            return Event::where('id', '=', $eventIds)->update(['delete_flag' => 1]);
        } else {
            DB::beginTransaction();
            $delete = Event::whereIn('id', $eventIds)->update(['delete_flag' => 1]);
            if ($delete) {
                DB::commit();
                return true;
            } else {
                DB::rollback();
                return false;
            }
        }
    }

}
