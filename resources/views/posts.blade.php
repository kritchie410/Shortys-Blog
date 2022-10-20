<x-layout>

    @foreach ($posts as $post)
        <article>
            {{-- option to select classes  --}}
            {{-- <article class="{{ $loop->even ? 'foobar' : '' }}"> --}}
            <h1>
                <a href="/posts/{{ $post->slug }}">

                    {{ $post->title }}
                </a>
            </h1>
            <div>
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach

</x-layout>
