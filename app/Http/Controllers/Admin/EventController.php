<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\EventServiceInterface;
use App\Http\Requests\Admin\StoreEventRequest;
use Illuminate\Http\Request;
use App\Models\Partner;

class EventController extends AdminBaseController
{
    protected $eventService;
    public function __construct(EventServiceInterface $eventService)
    {
        parent::__construct();
        $this->eventService = $eventService;
    }

    public function index(Request $request) {
        return view('admin.event.index', [
            'fields' => $request->input('fields', []),
            'sorts' => $request->input('sorts', []),
            'page' => $request->input('page', 1),
        ]);
    }

    public function getEvents(Request $request) {
        // @todo: sort by input sorts
        $events = $this->eventService->getEventLists($request->all());

        return response()->json([
            'templates' => [
                'rows' => view('admin.event.rows', compact('events'))->render(),
                'pagination' => $events->links()->toHtml(),
            ],
            'url' => route('event_lists', $request->all()),
        ]);
    }

    public function create() {
        $partners = Partner::all();
        return view('admin.event.create', compact('partners'));
    }

    public function store(StoreEventRequest $request) {
        if ($request->eventId) {
            $updateEventStatus = $this->eventService->update($request->all());
        } else {
            $addEventstatus = $this->eventService->add($request->all());
        }
        if (isset($addEventstatus) || isset($updateEventStatus)) {
            return redirect()->to('admin/event')->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function update(Request $request, $eventId) {
        $event = $this->eventService->getEventById($eventId);
        $partners = Partner::all();
        return view('admin.event.update', compact('event', 'partners'));
    }

    public function eventListsDelete(Request $request) {
        $eventIds = $request->input('eventIds');
        $status = $this->eventService->delete($eventIds);

        return response()->json(compact('status'));
    }

    public function delete(Request $request, $eventId) {
        $deleteStatus = $this->eventService->delete($eventId);

        if ($deleteStatus) {
            return redirect()->back()->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function getEventById() {
        return view('admin.event.create');
    }
}
