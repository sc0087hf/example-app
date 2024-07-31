<?php

namespace App\Http\Controllers\Tweet\MemberPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweets = $tweetService->getMemberTweet($request->userId);
        $user = $tweetService->getUserName($request->userId);
        $countTweet = $tweetService->countTweet($request->userId);
        return view('tweet.member-page', compact(['tweets', 'user', 'countTweet']));
    }
}
