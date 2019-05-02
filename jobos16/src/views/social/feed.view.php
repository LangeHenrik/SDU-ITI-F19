@view(layout.social.header, {
    "title": "Feed"
})

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-8">
            @foreach(Picture::all() as $picture)
                <div class="card mb-3">
                    <img src="{{ $publicBasePath }}/uploads/{{ $picture->file }}" class="card-img-top" alt="{{ $picture->caption }}">
                    <div class="card-body">
                        <p class="card-text">
                            <b>{{ $picture->userName }}</b><br />
                            {{ $picture->caption }}
                        </p>
                        <a href="#" class="card-link cardPictureLike" onclick="like('{{ $picture->id }}'); return false;" id="picture-like-{{ $picture->id }}">👍 {{ $picture->likes }}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <!-- Profile card -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Upload new image -->
            <div class="mt-3">
                <a href="{{ $base }}/feed/upload" class="btn btn-primary btn-block">Upload picture</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    function like(id) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            switch (request.readyState) {
                case XMLHttpRequest.DONE:
                    if(request.status == 200) {
                        document.getElementById(`picture-like-${id}`).innerHTML = `👍 ${request.responseText}`;
                    }
                    break;
                default:
                    break;
            }
        };

        request.open("GET", `{{ $base }}/feed/item/${id}/like`, true);
        request.send();
    }
</script>
@endsection