@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    {{-- Table section --}}
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Deliveries</div>

          <div class="card-body">
            <div class="filters">
              <form id="delivery-filter-form" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="card form-group">
                      <div class="card-header">
                        <label for="exampleFormControlSelect2">Choose A County</label>
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

                  <div class="col-md-6">
                    <div class="card form-group">
                      <div class="card-header">
                        <label for="exampleFormControlSelect2">Choose A State</label>
                      </div>
                      <div class="card-body">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="status-all" value="" {{ !Request::query('status')  ? 'checked' : '' }}>
                          <label class="form-check-label" for="status1">All States</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="status1" value="pending" {{ strpos(Request::query('status') , 'pending') !== FALSE ? 'checked' : '' }}>
                          <label class="form-check-label" for="status1">Pending</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="status2" value="delivered" {{ strpos(Request::query('status') , 'delivered') !== FALSE ? 'checked' : '' }}>
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
                  <th scope="col">Sender County</th>
                  <th scope="col">Sender Town</th>
                  <th scope="col">Recipient Name</th>
                  <th scope="col">Recipient County</th>
                  <th scope="col">Recipient Town</th>
                  <th scope="col">Item Weight</th>
                  <th scope="col">Delivery Status</th>
                  <th scope="col"></th>

                  <th scope="col">Sender Number</th>
                  <th scope="col">Recipient Number</th>
                  <th scope="col">Agent Name</th>
                  <th scope="col">Description</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payload as $item)
                  <tr>
                    <td class="details-control"></td>
                    <td>{{ $item->delivery_no }}</td>
                    <td>{{ $item->sender_name }}</td>
                    <td>{{ ucwords(str_replace(['-', '_'], ' ', $item->sender_location)) }}</td>
                    <td>{{ ucwords(str_replace(['-', '_'], ' ', $item->sender_town)) }}</td>
                    <td>{{ $item->recipient_name }}</td>
                    <td>{{ ucwords(str_replace(['-', '_'], ' ', $item->recipient_location)) }}</td>
                    <td>{{ ucwords(str_replace(['-', '_'], ' ', $item->recipient_town)) }}</td>
                    <td>{{ $item->weight}}  kg</td>
                    <td class="font-weight-bold"> 
                      @if($item->delivery_status == 'PENDING')
                        <a href="#" class="btn-danger btn-sm text-white">{{$item->delivery_status}}</a>
                      @else
                        <a class="btn-sm btn-success text-white">{{$item->delivery_status}}</a>
                      @endif
                    </td>
                    <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>

                    <td>{{ $item->sender_number }}</td>
                    <td>{{ $item->recipient_number }}</td>
                    <td>{{ $item->agent_name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->date }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Order No</th>
                  <th scope="col">Sender Name</th>
                  <th scope="col">Sender County</th>
                  <th scope="col">Sender Town</th>
                  <th scope="col">Recipient Name</th>
                  <th scope="col">Recipient County</th>
                  <th scope="col">Recipient Town</th>
                  <th scope="col">Item Weight</th>
                  <th scope="col">Delivery Status</th>
                  <th scope="col"></th>

                  <th scope="col">Sender Number</th>
                  <th scope="col">Recipient Number</th>
                  <th scope="col">Agent Name</th>
                  <th scope="col">Description</th>
                  <th scope="col">Date</th>
                </tr>
              </tfoot>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
