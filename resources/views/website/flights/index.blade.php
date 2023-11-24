@extends('website.layouts.master')

@section('title')
    All Flights
@endsection

@section('header')

    <style>
        table th , table td {
            text-align: center !important
        }
    </style>

@endsection

@section('content')

    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left" style="margin-bottom: 30px">
                    <h2> All Flights </h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('flights.create') }}"> Create Flight</a>
                </div>
            </div>
        </div>

        @include('flash-message')

        <table class="table table-bordered"  style="margin-top: 30px">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Offfer ID</th>
                    <th>Caree</th>
                    <th>Price</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($flights != null && $flights->count() > 0)
                    @foreach ($flights as $index => $flight)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $flight->offer_id }}</td>
                            <td>{{ $flight->caree }}</td>
                            <td>{{ $flight->total_fare }} {{ $flight->currency }}</td>
                            <td>
                                <form action="{{ route('flights.destroy',$flight->id) }}"  id="form-{{  $flight->id  }}" method="Post">
                                    <a class="btn btn-primary" href="{{ route('flights.edit',$flight->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" id="btnDelete" name="{{  $flight->id  }}" class="btn btn-danger">
                                        Delete
                                    </a>
                                </form>

                                <script type="javascript">
                                    document.onsubmit=function(){
                                        return confirm('Sure?');
                                    }
                                </script>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr  style="text-align: center">
                        <td colspan="5">
                            sorry no any flights
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if($flights != null && $flights->count() > 0)

            {!! $flights->links() !!}

        @endif

    </div>

@endsection

@section('footer')

    <script>

        $(document).ready(function() {

            $('#btnDelete').click(function() {

                var ID = $(this).attr('name');

                if(ID) {

                    swal({
                        title: "Do You Want To Delete This Row ?",
                        text: "after delete this row you can't go back",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "yes",
                        cancelButtonText: "no",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('#form-'+ID).submit();

                        }
                    });
                }

            });

        });

    </script>

@endsection
