<?php

namespace App\Http\Controllers;

use OneSignal;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use Symfony\Component\HttpFoundation\Response;


class EventController extends Controller
{
    /**
     * Display a listing of the event
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return EventResource::collection(Event::all());
    }

    /**
     * Store new event
     *
     * @param EventRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request)
    {
        $new_event = Event::create($request->all());

        // Create push notification
        $event_name = $request->input('event_name');
        $event_start = $request->input('start_date');

        $this->createPushNotification($event_name, $event_start);

        return response()->json([
            'date' => new EventResource($new_event),
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
     * Update event
     *
     * @param EventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());

        $event_name = $request->input('event_name');
        $event_start = $request->input('start_date');
        $this->testTimeNotification($event_name, $event_start);

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

    /**
     * Create push notification
     *
     * @return mixed
     */
    public function createPushNotification($event_name, $start_date)
    {
        $userId = "a259b549-b42b-447b-9e3b-acd40cf6f067"; // UserId Subscriber Web One Signal
        $params = [];
        $params['include_player_ids'] = [$userId];
        $contents = [
            "en" => $event_name,
        ];
        $params['contents'] = $contents;
        $params['send_after'] = $start_date;

         \OneSignal::sendNotificationCustom($params);
    }
}
