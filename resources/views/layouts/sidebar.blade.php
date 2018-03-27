<div class="blog-sidebar">
    <div class="sidebar-module">
        <h4>Movies By Genre</h4>
        <ol class="list-unstyled">
            @foreach($genres as $genre)
                <li>
                    <a href="/movie/genre?genre={{ $genre->name }}">
                        @if( $genre->movies->count() > 0 )
                            {{ $genre->name }} ( {{ $genre->movies->count() }} )
                        @endif
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
</div>