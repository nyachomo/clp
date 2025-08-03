<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;

class GoogleMeetController extends Controller
{
    //
    public function createMeeting(Request $request)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Calendar::CALENDAR);
        
        // Set the access token (you'll need to implement OAuth flow)
        $client->setAccessToken(auth()->user()->google_token);
        
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            // Update user's token in database
        }
        
        $calendar = new Calendar($client);
        
        $event = new Event([
            'summary' => $request->input('title', 'Class Meeting'),
            'description' => $request->input('description', 'Online Class'),
            'start' => new EventDateTime([
                'dateTime' => now()->addMinutes(5)->format(\DateTimeInterface::RFC3339),
                'timeZone' => config('app.timezone'),
            ]),
            'end' => new EventDateTime([
                'dateTime' => now()->addHours(1)->format(\DateTimeInterface::RFC3339),
                'timeZone' => config('app.timezone'),
            ]),
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet'
                    ]
                ]
            ],
            'attendees' => [
                ['email' => auth()->user()->email],
            ],
        ]);
        
        $event = $calendar->events->insert('primary', $event, ['conferenceDataVersion' => 1]);
        
        return $event->getHangoutLink();
    }
    
    public function joinMeeting($meetingId)
    {
        return view('meeting', [
            'meetingUrl' => "https://meet.google.com/{$meetingId}"
        ]);
    }
}
