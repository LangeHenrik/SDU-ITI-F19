@view(layout.header, {
    "title": "Register account"
})

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-5 mt-5">
            <h2 class="text-brand">Social Network</h2>

            @if(Input::get('error') == true)
            <div class="alert alert-danger mt-5" role="alert">
                Unable to create account
            </div>
            @endif

            <div class="card mt-5">
                <div class="card-header">
                    Register new account
                </div>
                <div class="card-body">
                    <form action="/auth/register" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Last name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="inputGender" name="gender" required>
                                <option value="0" disabled selected>Select a gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputCity" name="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="inputZip" name="zip" placeholder="Zip code" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create account</button>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Already have an account? <a href="/auth/login">Sign in</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection