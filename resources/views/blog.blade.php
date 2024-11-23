<x-layout>
    <x-slot:navbarSlot>
        @foreach ($posts as $post)
            <article
                class="rounded-xl my-4 py-4 md:py-8 mx-auto px-4 sm:px-6 lg:max-w-(--breakpoint-lg) border-solid border-2 border-gray-200">
                <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['title'] }}</h2>
                <div class="text-base text-gray-500">{{ $post['author'] }}</div>
                <p class="my-4 font-light">{{ Str::limit($post['body'], 100) }}</p>
                <a href="/post/{{ $post['id'] }}" class="font-medium text-blue-500 hover:underline">Read more &raquo</a>

            </article>
        @endforeach
    </x-slot:navbarSlot>

</x-layout>
