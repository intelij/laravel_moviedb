<div class="row justify-content-center">
    <div class="col-md-12">
        <hr>
        <div class="card">
            <div class="card-header">
                Synchronize the entire Database
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/syncAll">
                    {{csrf_field()}}

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-dark btn-block" id="syncAll">
                            Synchronize
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>