{{-- @props([
    'tweets' => []
]) --}}
@if($tweets->isEmpty())
    <h2 class="text-center font-bold mt-8 mb-8">{{ $user->name }}さんはまだつぶやいていません。</h2>
@else
    {{-- <p class="p-4">{{ $tweets->count()}}件つぶやきがあります←違う。</p> --}}
    <div class="bg-white rounded-md shadow-lg mt-5 mb-5">
        <ul>
            @foreach($tweets as $tweet)
                <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
                    <div>
                        <a href="{{ route('tweet.member', [$tweet->user_id])}}">
                            <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                                {{ $tweet->user->name }}
                            </span>
                        </a>
                        <p class="text-gray-600">{!! nl2br(e($tweet->content)) !!}</p>
                        <x-tweet.images :images="$tweet->images" />
                    </div>
                    <div>
                        <!-- TODO 編集と削除 -->
                        <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id"></x-tweet.options>
                    </div>
                </li>
            @endforeach
        </ul>    
    </div>
    <div class="mb-4">
        {{ $tweets->links() }}
    </div>
@endif
