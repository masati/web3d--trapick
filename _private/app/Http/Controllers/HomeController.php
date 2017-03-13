<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use App\Models\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Pagination;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\Authenticatable;
use LaravelLocalization;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('home', [
            'title' => trans('app.home-title'),
        ]);
    }

    public function getPage($url = '')
    {
        if (empty($url)) {
            return redirect('/');
        } else {
            $page = Page::where('url', $url)
                ->where('locale', LaravelLocalization::getCurrentLocale())
                ->first();
            if( $page )
                return view('page', [
                    'content' => $page->content,
                    'title' => $page->title
                ]);
            else
                return redirect('/');
        }
    }

    public function getFeed()
    {
        $content = Page::where('url', 'contacts')
            ->where('is_published', 1)
            ->where('locale', LaravelLocalization::getCurrentLocale())
            ->first();
        return view('contacts', [
            'content' => $content->content,
            'title' => $content->title
        ]);
    }

    public function postFeed(Request $request)
    {

        $input = $request->all();

        if (Auth::check()) {
            $user = auth()->user();
            $user_id = $user->id;
        }
        else {
            $user_id = null;
        }

        $data = [
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'user_id' => $user_id,
            'institution' => $input['institution'],
            'email' => $input['email'],
            'query' => $input['query'],
        ];

        $this->validate($request, [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'institution' => 'max:30',
            'query' => 'min:10',
            'email' => 'required|email|max:30',
        ]);

        $feedback = new Feedback($data);

        $feedback->save();
        $email = Setting::find('email_feedback')->value;
        Mail::send('emails.feedback', ['data' => $data],
            function ($message) use ($email, $data) {
                $message->to($email)->subject('New feedback from 4hq user <' . $data['first_name'] . ' ' . $data['last_name'] . '>');
            });

        $content = Page::where('url', 'contacts')
            ->where('is_published', 1)
            ->where('locale', LaravelLocalization::getCurrentLocale())
            ->first();
        return view('contacts', [
            'content' => $content->content,
            'title' => $content->title,
            'message' => trans('app.txt-message_sent_success')
        ]);
    }
}
