<x-layout title="TOP | つぶやきアプリ">
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            つぶやきアプリ
        </h2>
        
        <x-tweet.form.post></x-tweet.form.post>
        <x-tweet.form.member-fileter :users="$users"></x-tweet.form.member-fileter>
        <div class="bg-white rounded-md shadow-lg mt-4 p-4">
            @auth
                <a href="{{ route('export.csv') }}" class="">ユーザー情報をCSVファイルで出力する</a>    
            @endauth
        </div>
        <x-tweet.list :tweets="$tweets"></x-tweet.list>
    </x-layout.single>
</x-layout>