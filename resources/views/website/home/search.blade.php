@extends('website.layouts.master')

@section('title')
All Search
@endsection

@section('header')

<style>
    table th,
    table td {
        text-align: center !important
    }

    .lds-default {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-default div {
        position: absolute;
        width: 6px;
        height: 6px;
        background: red;
        border-radius: 50%;
        animation: lds-default 1.2s linear infinite;
    }

    .lds-default div:nth-child(1) {
        animation-delay: 0s;
        top: 37px;
        left: 66px;
    }

    .lds-default div:nth-child(2) {
        animation-delay: -0.1s;
        top: 22px;
        left: 62px;
    }

    .lds-default div:nth-child(3) {
        animation-delay: -0.2s;
        top: 11px;
        left: 52px;
    }

    .lds-default div:nth-child(4) {
        animation-delay: -0.3s;
        top: 7px;
        left: 37px;
    }

    .lds-default div:nth-child(5) {
        animation-delay: -0.4s;
        top: 11px;
        left: 22px;
    }

    .lds-default div:nth-child(6) {
        animation-delay: -0.5s;
        top: 22px;
        left: 11px;
    }

    .lds-default div:nth-child(7) {
        animation-delay: -0.6s;
        top: 37px;
        left: 7px;
    }

    .lds-default div:nth-child(8) {
        animation-delay: -0.7s;
        top: 52px;
        left: 11px;
    }

    .lds-default div:nth-child(9) {
        animation-delay: -0.8s;
        top: 62px;
        left: 22px;
    }

    .lds-default div:nth-child(10) {
        animation-delay: -0.9s;
        top: 66px;
        left: 37px;
    }

    .lds-default div:nth-child(11) {
        animation-delay: -1s;
        top: 62px;
        left: 52px;
    }

    .lds-default div:nth-child(12) {
        animation-delay: -1.1s;
        top: 52px;
        left: 62px;
    }

    @keyframes lds-default {

        0%,
        20%,
        80%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.5);
        }
    }
</style>

@endsection

@section('content')

<div class="container mt-2">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" style="margin-bottom: 30px">
                <h2> Search </h2>
            </div>
        </div>
    </div>

    @include('flash-message')

    <table class="table table-bordered" style="margin-top: 30px">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Offfer ID</th>
                <th>Caree</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>

    <div id="loader" style="text-align: center;margin-top:40px">
        <div class="lds-default">
            @for($i=1;$i<=12;$i++) <div>
        </div>
        @endfor
    </div>
</div>

</div>

@endsection

@section('footer')

<script>
    $.ajax({
            url: '{{ url('search-flights') }}',
            type: "GET",
            dataType: "json",
            success:function(response) {

                $('#loader').remove();

                if(response.status == 'success') {

                    const apiArr = response.api_arr;
                    const flightArr = response.flights;

                    let counter = 0;

                    apiArr.map((api_element,index) => {

                        const matchEl = flightArr.find(el => el.offer_id === api_element.OfferId)

                        if (matchEl) {

                            const row = '<tr>'+
                                '<td>'+(counter + 1)+'</td>'+
                                '<td>'+matchEl.offer_id+'</td>'+
                                '<td>'+matchEl.caree+'</td>'+
                                '<td>'+matchEl.total_fare+'</td>'+
                            '</tr>';

                            $('#tbody').append(row);

                            counter++;

                        } else {

                            if(flightArr[index]) {

                                const row1 = '<tr>'+
                                    '<td>'+(counter + 1)+'</td>'+
                                    '<td>'+flightArr[index].offer_id+'</td>'+
                                    '<td>'+flightArr[index].caree+'</td>'+
                                    '<td>'+flightArr[index].total_fare+'</td>'+
                                '</tr>';

                                $('#tbody').append(row1);

                                counter++;

                            }

                            const row2 = '<tr>'+
                                '<td>'+(counter + 1)+'</td>'+
                                '<td>'+api_element.OfferId+'</td>'+
                                '<td>'+api_element.Caree+'</td>'+
                                '<td>'+api_element.TotalFare+'</td>'+
                            '</tr>';

                            $('#tbody').append(row2);

                            counter++;


                        }
                    })

                } else {

                    const row = '<tr><td colspan="4"> something Went wrong  </td></tr>';

                    $('#tbody').append(row);

                }

            }
        });

</script>

@endsection
