<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\SuccessStories;

class FrontendController extends Controller
{
    //++++++++++++++++++++++++++ EVENTS :: Start ++++++++++++++++++++++++++//
    public function eventsList(){
        $eventsArr = Events::with('dp_pictures')->where('status', 1)->get();
        return view('eventslist')->with('eventsArr', $eventsArr);
    }

    public function eventDetails($event_slug){
        $eventsArr = Events::with('pictures')
                    ->where([
                        ['event_slug', '=', $event_slug],
                        ['status', '=', 1]
                    ])
                    ->first();

        return view('eventdetails')->with('eventsArr', $eventsArr);
    }
    //++++++++++++++++++++++++++ EVENTS :: End ++++++++++++++++++++++++++//

    //++++++++++++++++++++++++++ SUCCESS STORIES :: Start ++++++++++++++++++++++++++//
    public function successStoriesList(){
        $storiesArr = SuccessStories::with('dp_pictures')->where('status', 1)->get();
        return view('successstorieslist')->with('storiesArr', $storiesArr);
    }

    public function successStoryDetails($event_slug){
        $storiesArr = SuccessStories::with('pictures')
                    ->where([
                        ['story_slug', '=', $event_slug],
                        ['status', '=', 1]
                    ])
                    ->first();

        return view('successstorydetails')->with('storiesArr', $storiesArr);
    }
    //++++++++++++++++++++++++++ SUCCESS STORIES :: End ++++++++++++++++++++++++++//
}
