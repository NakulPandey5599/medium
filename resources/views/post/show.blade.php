<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">Create new post</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class= "text-2xl mb-4" >{{ $post->title}}</h1>
                <div class="flex gap-4">
                    @if($post->user->image)
                    <img src="{{ $post->user->imageUrl() }}" alt="{{
                    $post->user->name}}" class="w-12 h-12 rounded-full">
                    @else
                    <img src= "https://www.freepik.com/free-vector/smiling-young-man-illustration_336635642.htm#fromView=keyword&page=1&position=4&uuid=aefb40f5-39c1-4e66-b8f6-c40b45061eb2&query=Avatar"
                     alt ="Avatar" class="w-12 h-12 rounded-full" >
                     @endif
                <div>
                    <h3>{{$post->user->name}}</h3>
                    <div class="flex gap-2 text-sm text-gray-500">
                        <span class="text-sm text-gray-500">{{ $post->readTime() }} min read</span>
                        <span>{{ $post->created_at() }}</span>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>