<x-app-layout>
    <div class="flex md:flex-row flex-col">
        <div class="md:mr-10 mr-0 text-center">
            <img src="{{asset($post->file)}}" class="w-96">
            @auth
            <a href="/new/{{$post->id}}" class="text-xl">add child</a>
            @endauth
        </div>
        <div>
            @foreach ($post->children->reverse() as $child)
                @unless ($child->id === 1)
                <div>
                    <a href="/posts/{{$child->id}}"><img src="{{asset($child->file)}}" class="w-96"></a>
                <div>
                @endunless
            @endforeach
        </div>
    </div>
</x-app-layout>
