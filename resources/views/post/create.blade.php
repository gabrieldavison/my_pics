<x-app-layout>
   <h1>Posts Create</h1>
   <form method="POST" action="/posts" enctype="multipart/form-data">
    @csrf
        <label for="caption">Caption</label>
        <input type="file" name="file" id="">
        <input name="parent_id" type="hidden" value="{{$parent}}">
        <button type="submit">Submit</button>
    </form>
</x-app-layout>