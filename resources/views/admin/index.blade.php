@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    {{-- Table section --}}
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
            <div class="filters">
              <form id="filter-form" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="card form-group">
                      <div class="card-header">
                        <label for="exampleFormControlSelect2">Choose the locations</label>
                      </div>
                      <div class="card-body">
                        <div class="form-check form-check-inline">
                          <input name="locations" class="form-check-input" type="checkbox" id="location1" value="kileleshwa" checked="">
                          <label class="form-check-label" for="location1">Kileleshwa</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="locations" class="form-check-input" type="checkbox" id="location2" value="buruburu" checked="">
                          <label class="form-check-label" for="location2">Buruburu</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="locations" class="form-check-input" type="checkbox" id="location3" value="south_c" checked="">
                          <label class="form-check-label" for="location3">South C</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="card form-group">
                      <div class="card-header">
                        <label for="exampleFormControlSelect2">Choose the locations</label>
                      </div>
                      <div class="card-body">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="status-all" value="" checked>
                          <label class="form-check-label" for="status1">All</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="status1" value="pending">
                          <label class="form-check-label" for="status1">Pending</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="status2" value="delivered">
                          <label name="status" class="form-check-label" for="status2">Delivered</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 offset-md-10">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                  </div>
                </div>
              </form>
            </div>

            {{-- Details of each delivery --}}
            <table id="deliveries-table" class="table table-striped w-100 table-sm datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Order No</th>
                  <th scope="col">Sender Name</th>
                  <th scope="col">Sender Location</th>
                  <th scope="col">Recipient Name</th>
                  <th scope="col">Recipient Location</th>
                  <th scope="col">Item Weight</th>
                  <th scope="col">Delivery Status</th>

                  <th scope="col">Sender Number</th>
                  <th scope="col">Recipient Number</th>
                  <th scope="col">Agent Name</th>
                  <th scope="col">Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payload as $item)
                  <tr>
                    <td class="details-control"></td>
                    <td>{{$item->delivery_no}}</td>
                    <td>{{$item->sender_name}}</td>
                    <td>{{ucwords($item->sender_location)}}</td>
                    <td>{{$item->recipient_name}}</td>
                    <td>{{ucwords($item->recipient_location)}}</td>
                    <td>{{$item->weight}} kg</td>
                    <td class="font-weight-bold {{ $item->delivery_status == 'DELIVERED' ? 'text-success' : 'text-danger' }}">{{$item->delivery_status}}</td>

                    <td>{{$item->sender_number}}</td>
                    <td>{{$item->recipient_number}}</td>
                    <td>{{$item->agent_name}}</td>
                    <td>{{$item->description}}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Order No</th>
                  <th scope="col">Sender Name</th>
                  <th scope="col">Sender Location</th>
                  <th scope="col">Recipient Name</th>
                  <th scope="col">Recipient Location</th>
                  <th scope="col">Item Weight</th>
                  <th scope="col">Delivery Status</th>

                  <th scope="col">Sender Number</th>
                  <th scope="col">Recipient Number</th>
                  <th scope="col">Agent Name</th>
                  <th scope="col">Description</th>
                </tr>
              </tfoot>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
