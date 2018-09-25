@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            <form id="add-delivery-form" method="post" action="{{ route('home.store') }}">
              {{ csrf_field() }}

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="recipient_id">
                    Choose a recipient
                    <a tabindex="0" class="form-popover" role="button" data-toggle="popover" data-trigger="hover focus" title="Choose a recipient" data-content="Select the name of the person you would like to make a delivery to."><i class="icon ion-ios-help"></i></a>
                  </label>
                  <select class="form-control{{ $errors->has('recipient_id') ? ' is-invalid' : '' }}" required name="recipient_id">
                    @foreach ($payload['users'] as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('recipient_id'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('recipient_id') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="weight">
                    Weight (kgs)
                    <a tabindex="0" class="form-popover" role="button" data-toggle="popover" data-trigger="hover focus" title="Set the delivery item weight" data-content="Enter the weight of the item in kg. If the exact weight is not available, round up to the nearest weight."><i class="icon ion-ios-help"></i></a>
                  </label>
                  <input type="number" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" min=".5" step="0.5" name="weight" id="weight" placeholder="Enter item weight." required>
                  @if ($errors->has('weight'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('weight') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="description">Description</label>
                  <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name=description id="description" rows="3" placeholder="Enter the product description." required></textarea>
                  @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group col-md-12 row">
                <div class="p-0 mr-auto col-md-6">
                  <button type="submit" class="btn btn-primary">Request a delivery</button>
                </div>
                <div class="p-0 ml-auto col-md-6 text-right">
                  <div class="valid-feedback d-block">
                    {{ $payload['message'] ? $payload['message'] : '' }}
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
