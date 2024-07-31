@props([
    'userId' => $user->id,
])
@dd($user->name)
    @auth
        <div class="bg-white rounded-md shadow-lg mt-4 p-4">
            <a href="{{ route('export.tweet.csv', compact('userId')) }}" class="">{{ $user->name }}さんのつぶやきをCSVファイルで出力する</a>    
        </div>
    @endauth