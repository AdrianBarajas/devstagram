<div>
    
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagenn del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class=" my-10">
            {{ $posts->links('pagination::simple-tailwind') }}
        </div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay post, empieza a seguir a alguien
            para mostrar sus posts
        </p>
    @endif
</div>