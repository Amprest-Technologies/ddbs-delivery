@extends('layouts.app')

@section('content')
  <div class="container" id="show">
    <div class="row">
      <div class="col-md-6">
        <ul class="card list-group">
          <li class="list-group-item"> <strong>Sender Name </strong> : {{$payload->sender_name}}</li>
          <li class="list-group-item"> <strong>Sender County </strong> : {{$payload->sender_location}}</li>
          <li class="list-group-item"> <strong>Sender Town </strong> : {{$payload->sender_town}}</li>
          <li class="list-group-item"> <strong>Sender Phone Number </strong> : {{$payload->sender_number}}</li>
        </ul>
      </div>
      <div class="col-md-6">
        <ul class="card list-group">
          <li class="list-group-item"> <strong>Recipient Name </strong> : {{$payload->recipient_name}}</li>
          <li class="list-group-item"> <strong>Recipient County </strong> : {{$payload->recipient_location}}</li>
          <li class="list-group-item"> <strong>Recipient Town </strong> : {{$payload->recipient_town}}</li>
          <li class="list-group-item"> <strong>Recipient Phone Number </strong> : {{$payload->recipient_number}}</li>
        </ul>
      </div>
      <div class="col-md-7">
        <ul class="card list-group">
          <li class="list-group-item"> <strong>Agent Name </strong> : {{$payload->agent_name}}</li>
          <li class="list-group-item"> <strong>Agent County </strong> : {{$payload->agent_location}}</li>
          <li class="list-group-item"> <strong>Agent Town </strong> : {{$payload->agent_town}}</li>
          <li class="list-group-item"> <strong>Agent Phone Number </strong> : {{$payload->agent_number}}</li>
        </ul>
      </div>
      <div class="col-md-5">
        <ul class="card list-group">
          <li class="list-group-item"> <strong>Item Weight </strong> : {{$payload->weight}}</li>
          <li class="list-group-item"> <strong>Item Description </strong> : {{$payload->description}}</li>
          <li class="list-group-item"> <strong>Item Delivery Status </strong> : {{$payload->delivery_status}}</li>
        </ul>
      </div>
    </div>
  </div>
@endsection
