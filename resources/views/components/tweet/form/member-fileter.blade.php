<div class="bg-white rounded-md shadow-lg">
    <form action="{{ route('tweet.post.member')}}" method="POST" class="p-4">
        @csrf
        <label for="member" class="mr-4">投稿者しぼりこみ</label>
        <select name="member" class="rounded-md mr-4">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="送信" class="cursor-pointer">
    </form>    

</div>
