<?php

namespace App\Http\Controllers\Tweet\MemberPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\TweetService;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweets = $tweetService->getMemberTweet($request->member);
        $user = $tweetService->getUserName($request->member);
        return view('tweet.member-page', compact(['tweets', 'user']));
    }
}
