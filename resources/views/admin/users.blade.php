@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    {{-- Table section --}}
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Users</div>

          <div class="card-body">
            <div class="filters">
              <form id="filter-form" enctype="multipart/form-data">
                <div class="form-row justify-content-center">
                  <div class="col-md-8">
                    <div class="card form-group">
                      <div class="card-header">
                        <label for="exampleFormControlSelect2">Choose the locations</label>
                      </div>
                      <div class="card-body">
                        <div class="form-check form-check-inline">
                          <input name="location" class="form-check-input" type="checkbox" id="location1" value="kileleshwa" {{ strpos(Request::query('location') , 'kileleshwa') !== FALSE ? 'checked' : '' }}>
                          <label class="form-check-label" for="location1">Kileleshwa</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="location" class="form-check-input" type="checkbox" id="location2" value="buruburu" {{ strpos(Request::query('location') , 'buruburu') !== FALSE  ? 'checked' : '' }}>
                          <label class="form-check-label" for="location2">Buruburu</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="location" class="form-check-input" type="checkbox" id="location3" value="south_c" {{ strpos(Request::query('location') , 'south_c') !== FALSE  ? 'checked' : '' }}>
                          <label class="form-check-label" for="location3">South C</label>
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
                  <th scope="col">Location</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Role</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payload as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ ucwords(str_replace('-', ' ', $user->location)) }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->role }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col">Customer No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Location</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Role</th>
                </tr>
              </tfoot>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
