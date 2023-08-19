<x-master-layout>
    @section("content")
    @if (session('create_success'))
    <div class="alert alert-success" role="alert">
        {{ session('create_success') }}
    </div>
    @elseif (session('create_error'))
    <div class="alert alert-danger" role="alert">
        {{ session('create_error') }}
    </div>
    @elseif (session('delete_success'))
    <div class="alert alert-success" role="alert">
        {{ session('delete_success') }}
    </div>
    @elseif (session('delete_error'))
    <div class="alert alert-danger" role="alert">
        {{ session('delete_error') }}
    </div>
    @endif
    <div class="row mb-2">
        <div class="col">
            <a class="btn btn-outline-primary" href="{{ route('meter.list')}}" role="button"><i class="fa-solid fa-chevron-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Meter Detail</h5>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>MPXN</th>
                                <td>{{ $meter->mpxn }}</td>
                            </tr>
                            <tr>
                                <th>Installation date</th>
                                <td>{{ $meter->installation_date }}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{ $meter->type }}</td>
                            </tr>
                            <tr>
                                <th>Estimated Annual Consumption</th>
                                <td>{{ $meter->estimated_annual_consumption }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Record new reading</h5>
                    <form method="post" action="{{ route('meter.reading.store', $meter->id) }}">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="number" name="value" class="form-control" id="value" placeholder="Enter the used value">
                          </div>
                        
                        <div class="form-group">
                            <label for="reading_date">Installadtion date</label>
                            <input type="date" name="reading_date" class="form-control" id="reading_date" placeholder="dd/mm/yyyy">
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Submit reading</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Record new reading</h5>
                    <form method="post" action="{{ route('meter.reading.autogenerate', $meter->id) }}">
                        @method('POST')
                        @csrf        
                        <div class="form-group">
                            <label for="reading_date">Installadtion date</label>
                            <input type="date" name="reading_date" class="form-control" id="reading_date" placeholder="dd/mm/yyyy">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Autogenerate reading</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reading records</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>reading date</th>
                                <th>reading value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meter->readings->reverse() as $reading)
                            <tr>
                                <td> {{ $reading->value }} </td>
                                <td> {{ $reading->reading_date }} </td>
                                <td>
                                    <form method="post" action="{{ route('meter.reading.destroy', [$meter->id, $reading->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
    @endsection
</x-master-layout>