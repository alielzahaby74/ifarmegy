
@if($errors->any())
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body alert-danger">
                    <div class="alert alert-danger m-0 p-0">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
