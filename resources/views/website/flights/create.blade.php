@extends('website.layouts.master')

@section('title')
    Add New Flight
@endsection

@section('content')

    <div class="container mt-2">

        <div class="row" style="margin-bottom:30px">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Flight</h2>
                </div>
            </div>
        </div>

        @include('flash-message')

        <form action="{{ route('flights.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px">
                    <div class="form-group">
                        <strong>Offer ID:</strong>
                        <input type="text" name="offer_id" value="{{ old('offer_id') }}" required class="form-control" placeholder="offer ID">
                        @error('offer_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px">
                    <div class="form-group">
                        <strong>Caree:</strong>
                        <input type="text" name="caree" value="{{ old('caree') }}" required class="form-control" placeholder="Caree">
                        @error('caree')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px">
                    <div class="form-group">
                        <strong>Total Fare:</strong>
                        <input type="text" name="total_fare" value="{{ old('total_fare') }}" required onkeypress="return isNumberKey(event)" class="form-control" placeholder="Total Fare">
                        @error('total_fare')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Currency:</strong>
                        <input type="text" name="currency" value="{{ old('currency') }}" required class="form-control" placeholder="Currency">
                        @error('currency')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 20px">
                    <button type="submit" class="btn btn-primary ml-3" style="margin-right: 20px;display: inline;width: auto;">Submit</button>
                    <a class="btn btn-primary" href="{{ route('flights.index') }}" style="margin-right: 20px;display: inline;width: auto;"> Back</a>
                </div>
            </div>

        </form>

    </div>

@endsection

@section('footer')

    <script>
        // is number //
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

@endsection
