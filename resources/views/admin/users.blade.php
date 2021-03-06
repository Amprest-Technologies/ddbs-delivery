@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    {{-- Table section --}}
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{$user == 'customer' ? 'Customers' : 'Agents'}}</div>
          <div class="card-body">
            <div class="filters">
              <form id="user-filter-form" enctype="multipart/form-data">
                <div class="form-row justify-content-center">
                  <div class="col-md-8">
                    <div class="card form-group">
                      <div class="card-header">
                        <label for="exampleFormControlSelect2">Choose the locations</label>
                      </div>
                      <div class="card-body">
                        <div class="form-check form-check-inline">
                          <input name="locations" class="form-check-input" type="checkbox" id="location1" value="nairobi" {{ strpos(Request::query('location') , 'nairobi') !== FALSE ? 'checked' : '' }}>
                          <label class="form-check-label" for="location1">Nairobi</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="locations" class="form-check-input" type="checkbox" id="location2" value="mombasa" {{ strpos(Request::query('location') , 'mombasa') !== FALSE  ? 'checked' : '' }}>
                          <label class="form-check-label" for="location2">Mombasa</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="locations" class="form-check-input" type="checkbox" id="location3" value="kisumu" {{ strpos(Request::query('location') , 'kisumu') !== FALSE  ? 'checked' : '' }}>
                          <label class="form-check-label" for="location3">Kisumu</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                  </div>
                </div>
              </form>
            </div>

            {{-- Details of each delivery --}}
            <table id="users-table" class="table table-striped w-100 table-sm datatable">
              <thead>
                <tr>
                  <th scope="col">Customer No</th>
                  <th scope="col">Name</th>
                  <th scope="col">County</th>
                  <th scope="col">Town</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Role</th>
                  <th scope="col">Created Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payload as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ ucwords(str_replace('-', ' ', $user->location)) }}</td>
                    <td>{{ ucwords(str_replace('-', ' ', $user->town)) }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ $user->created_at }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col">Customer No</th>
                  <th scope="col">Name</th>
                  <th scope="col">County</th>
                  <th scope="col">Town</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Role</th>
                  <th scope="col">Created Date</th>
                </tr>
              </tfoot>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
