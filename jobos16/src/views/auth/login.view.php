@view(layout.header, {
    "title": "Sign in"
})

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-5 mt-5">
            <h2 class="text-brand">Social Network</h2>

            @if(Input::get('created') == true)
                <div class="alert alert-success mt-5" role="alert">
                    Your account has been created!
                </div>
            @endif

            @if(Input::get('error') == true)
            <div class="alert alert-danger mt-5" role="alert">
                Incorrect email and password combination
            </div>
            @endif

            <div class="card mt-5">
                <div class="card-header">
                    Sign in
                </div>
                <div class="card-body">
                    <form action="/auth/login" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Don't have an account yet? <a href="/auth/register">Create one</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection