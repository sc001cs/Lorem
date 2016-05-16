@extends('secondLayout.app')

@section('content')

    <h3>Hello Section and yiead</h3>

    <h4>The list</h4>

    @if(count($citiesList))

        <ul>

        @foreach($citiesList as $city)

            <li>{{$city}}</li>

        @endforeach

        </ul>

    @endif

@endsection


@section('footer')

    <p>This is the footer</p>

@endsection
