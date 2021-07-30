<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Repositories\EventsRepository;
use App\Models\Event;
use Symfony\Component\HttpFoundation\Response;
use Berkayk\OneSignal\OneSignalFacade;

class EventController extends Controller
{

    public $eventsRepository;

    /**
     * EventController constructor.
     *
     * @param EventsRepository $eventsRepository
     */
    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }


    /**
     * Display a listing of the event
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return EventResource::collection(Event::all());
    }

    public function create()
    {

    }

    /**
     * Store new event
     *
     * @param EventRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request)
    {
        $event = $request->all();

        return response()->json([
            'date' => new EventResource($event),
            'message' => 'Event added successfully!!',
            'status' => Response::HTTP_CREATED
        ]);
    }


    /**
     * Display event
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response($event, Response::HTTP_OK);
    }

    /**
     * Edit event
     *
     * @param Event $event
     */
    public function edit(Event $event)
    {

    }

    /**
     * Update event
     *
     * @param EventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());
        return response()->json([
            'data' => new EventResource($event),
            'message' => "Event updated successfully!!",
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Delete event
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response('Event deleted!!', Response::HTTP_NO_CONTENT);
    }

    public function notification()
    {
        $data = OneSignalFacade::sendNotificationToAll(
            "Some Message",
            $url = 'sdfsf',
            $data = 'sdgfdsf',
            $buttons = null,
            $schedule = 'fsdfsdf'
        );
        var_dump($data);
    }


}
