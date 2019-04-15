@extends('layouts.app')

@section('title')
    Отчет №2: &laquo;Пустующие дома&raquo;
@endsection

@section('content')
    @component('components.panel')
        <table class='table'>
            <thead>
                <tr>
                    <th>Город</th>
                    <th>Улица</th>
                    <th>Пустующие дома</th>
                </tr>
            </thead>
            <tbody>
                @foreach($houses as $house)
                <tr>
                    <td>{{ $house->city }} {{ $house->city_socr }}.</td>
                    <td>{{ $house->street }} {{ $house->street_socr }}.</td>
                    <td>{{ $house->houses_numbers }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $houses->links() }}
    @endcomponent
@endsection