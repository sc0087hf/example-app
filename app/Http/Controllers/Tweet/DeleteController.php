<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TweetService;
use App\Models\Tweet;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;



class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweetId = (int) $request -> route('tweetId');
        $tweetCheck = $tweetService->checkOwnTweet($request->user()->id, $tweetId);
        if (!isset($tweetCheck)) {
            throw new AccessDeniedHttpException();
        }
        $tweetService->deleteTweet($tweetId);
        return redirect()->route('tweet.index')->with('message', 'つぶやきを削除しました。');
    }
}
