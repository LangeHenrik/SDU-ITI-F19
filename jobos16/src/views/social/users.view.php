@view(layout.social.header, {
    "title": "Users"
})

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Zip</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(User::all() as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->zip }}</td>
                            <td>{{ $u->city }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection