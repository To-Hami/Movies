@foreach($movie->genres as $genre)
    <h5>
        <span class="badge badge-primary">{{$genre->name}}</span>
    </h5>
@endforeach
