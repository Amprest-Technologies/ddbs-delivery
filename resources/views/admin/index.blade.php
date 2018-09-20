@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    12 Users
                  </div>
                </div>                
              </div>
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    12 Agents
                  </div> 
                </div>
              </div>
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    12 Deliveries
                  </div> 
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
