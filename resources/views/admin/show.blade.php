@extends('layouts.app')

@section('content')
  <div class="container-fluid" id="admin">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <p><span>{{ $customers }}</span> Customers</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <p><span>{{ $agents }}</span> Agents</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <p><span>{{ $pending }}</span> Pending Deliveries</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <p><span>{{ $delivered }}</span> Completed Deliveries</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
