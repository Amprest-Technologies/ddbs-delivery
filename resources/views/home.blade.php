@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
            <form id="add-delivery-form" method="post" action="{{ route('home.store') }}">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="recipient_id">Choose a recipient</label>
                  <select class="form-control" required name="recipient_id">
                    @foreach ($payload as $user)
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
                  <label for="weight">Weight</label>
                  <input type="number" class="form-control" min=".5" step="0.5" name="weight" id="weight" placeholder="Enter item weight.">
                  @if ($errors->has('weight'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('weight') }}</strong>
                    </span>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="description">Description</label>
                  <textarea class="form-control" name=description id="description" rows="3" placeholder="Enter the product description."></textarea>
                  @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Request a delivery</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
