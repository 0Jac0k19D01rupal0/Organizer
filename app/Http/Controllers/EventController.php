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
        $new_event = Event::create($request->all());

        // Create push notification
        $event_name = $request->input('event_name');
        $event_start = $request->input('start_date');
        $this->testTimeNotification($event_name, $event_start);

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
        global $notificationID;

        $event->update($request->all());

        // Update push notification
        $event_name = $request->input('event_name');
        $event_start = $request->input('start_date');

        // Cancel push notification by id notification
        $this->cancelNotification($notificationID);

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

    public function notification()
    {
       \OneSignal::sendNotificationToAll(
            "Some Message",
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
    }

    public function testRequestForNotification()
    {

    }

    /**
     * Create push notification
     *
     * @return mixed
     */
    public function testTimeNotification($event_name, $start_date)
    {
        global $notificationID;

        $userId = "a259b549-b42b-447b-9e3b-acd40cf6f067"; // UserId Web One Signal
        $params = [];
        $params['include_player_ids'] = [$userId];
        $contents = [
            "en" => $event_name,
        ];
        $params['contents'] = $contents;
//        $params['delayed_option'] = "UTC+300"; // Will deliver on user's timezone
        $params['send_after'] = $start_date;
//        $params['delivery_time_of_day'] = "1:15"; // Delivery time

        /// In this part get response from OneSignal
        $dataOneSignal = \OneSignal::sendNotificationCustom($params);

        $responseOneSignal = $dataOneSignal->getBody();
        $decodedResponse = json_decode($responseOneSignal);
        $notificationID = $decodedResponse->id();
    }


    /**
     * Cancel push notification
     *
     */
    public function cancelNotification($notificationId)
    {
        $ch = curl_init();
        $appId = getenv("ONESIGNAL_APP_ID");
        $restApi = getenv("ONESIGNAL_REST_API_KEY");
        $httpHeader = array(
            'Authorization: Basic' . $restApi
        );
        $notificationId = "61eb2c9e-92cb-4926-8494-a56ef8df8a9a";

        $url = "https://onesignal.com/api/v1/notifications/" . $notificationId . "?app_id=" . $appId;

        $options = array (
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $httpHeader,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_CUSTOMREQUEST => "DELETE",
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
