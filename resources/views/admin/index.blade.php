@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            {{-- Details of each delivery --}}
            <table id="deliveries-table" class="table table-striped w-100 table-sm">
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
