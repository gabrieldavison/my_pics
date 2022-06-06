<x-app-layout>
    <div class="flex md:flex-row flex-col">
        <div class="md:mr-10 mr-0">
            <img src="{{asset($post->file)}}" class="w-96">
            @auth
            <a href="/new/{{$post->id}}" class="text-2xl">+</a>
            @endauth
        </div>
        <div>
            @foreach ($post->children->reverse() as $child)
                @unless ($child->id === 1)
                <div>
                    <a href="/posts/{{$child->id}}"><img src="{{asset($child->file)}}" class="w-96"></a>
                    @auth
                        <a href="/new/{{$child->id}}" class="text-2xl">+</a>
                    @endauth
                @endunless
                <div>
            @endforeach
        </div>
    </div>
</x-app-layout>
