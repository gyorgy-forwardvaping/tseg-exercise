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
    <div class="row mb-4 flex-row-reverse">
        <div class="col-2">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#meterModal">
                <i class="fa-solid fa-plus"></i> Add new Meter
              </button>    
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>MPXN</th>
                        <th>Installation Date</th>
                        <th>Type</th>
                        <th>Estimated annual consumption</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meters as $meter)
                    <tr>
                        <td>{{$meter->mpxn}}</td>
                        <td>{{$meter->installation_date}}</td>
                        <td>{{$meter->type}}</td>
                        <td>{{$meter->estimated_annual_consumption}}</td>
                        <td>
                            
                            <a class="btn btn-outline-primary" href="{{ route('meter.view', $meter->id) }}" role="button">Details</a>
                                
                            <form method="POST" action="{{ route('meter.destroy', $meter->id) }}" class="inlineForm">
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
    <!-- Modal -->
    <div class="modal fade" id="meterModal" tabindex="-1" role="dialog" aria-labelledby="meterModalLabel" aria-hidden="true">
        <form method="post" action="{{ route('meter.store') }}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add nem Meter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
                <div class="form-group">
                  <label for="mpxn">MPXN</label>
                  <input type="number" name="mpxn" class="form-control" id="mpxn" placeholder="Enter MPXN">
                </div>
                <div class="form-group">
                  <label for="installDate">Installadtion date</label>
                  <input type="date" name="installation_date" class="form-control" id="installDate" placeholder="dd/mm/yyyy">
                </div>
              <div class="form-group">
                <label for="typeSelect">Type</label>
                <select class="custom-select" id="typeSelect" name="type">
                  <option selected>Choose...</option>
                  <option value="electricity">Electricity</option>
                  <option value="gas">Gas</option>
                </select>
              </div>
              <div class="form-group" name="aec">
                  <label for="eac">estimated annual consumption</label>
                  <input type="number" min="2000" max="8000" class="form-control" name="eac" id="eac" placeholder="2000-8000">
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-primary">Add new Meter</button>
          </div>
        </div>
      </div>
            </form>
    </div>
    
    @endsection
</x-master-layout>