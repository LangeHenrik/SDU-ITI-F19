@view(layout.social.header, {
"title": "Feed"
})

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-5 mt-5">
            <div class="card mt-5">
                <div class="card-header">
                    Upload new picture
                </div>
                <div class="card-body">
                    <form action="{{ $base }}/feed/upload" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputFile">Select photo</label>
                            <input type="file" class="form-control-file" id="inputFile" name="file">
                        </div>
                        <div class="form-group">
                            <label for="inputCaption">Caption</label>
                            <textarea class="form-control" id="inputCaption" name="caption" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection