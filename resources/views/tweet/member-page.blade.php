<x-layout title="つぶやきアプリ">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            {{ $user->name }}さんのつぶやき
        </h2>
        @php
            $userName = $user->name;
            $breadcrumbs = [
                ['href' => route('tweet.index'), 'label' => 'TOP'],
                ['href' => '#', 'label' => $userName . "さんのつぶやき"]
            ];
        @endphp
            <x-element.breadcrumbs :breadcrumbs="$breadcrumbs"></x-element.breadcrumbs>
            <x-tweet.list-member :tweets="$tweets" :user="$user" :countTweet="$countTweet"></x-tweet.list-member>
        </x-layout.single>
</x-layout>