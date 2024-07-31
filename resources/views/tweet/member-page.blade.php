<x-layout title="つぶやきアプリ">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            {{ $user->name }}さんのつぶやき
        </h2>
        @php
            $userName = $user->name;
            $userId = $user->id;
            $breadcrumbs = [
                ['href' => route('tweet.index'), 'label' => 'TOP'],
                ['href' => '#', 'label' => $userName . "さんのつぶやき"]
            ];
        @endphp
            <x-element.breadcrumbs :breadcrumbs="$breadcrumbs"></x-element.breadcrumbs>
            @auth
            <div class="bg-white rounded-md shadow-lg mt-4 p-4">
                <a href="{{ route('export.tweet.csv', compact('userId')) }}" class="">{{ $user->name }}さんのつぶやきをCSVファイルで出力する</a>    
            </div>
            @endauth
            <x-tweet.list-member :tweets="$tweets" :user="$user" :countTweet="$countTweet"></x-tweet.list-member>
        </x-layout.single>
</x-layout>