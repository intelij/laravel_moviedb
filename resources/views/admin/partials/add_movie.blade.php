<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Add a movie
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/sync">
                    {{csrf_field()}}

                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label text-md-right">Movie Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-dark" id="sync">
                                Synchronize
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>