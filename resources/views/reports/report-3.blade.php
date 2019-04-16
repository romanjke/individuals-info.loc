@extends('layouts.app')

@section('title')
    Отчет №3: &laquo;Город, улица, № дома для пустующих домов&raquo;
@endsection

@section('content')
    @component('components.panel')
        <table class='table'>
            <thead>
                <tr>
                    <th>Город</th>
                    <th>Улица</th>
                    <th>Интервал домов</th>
                </tr>
            </thead>
            <tbody>
                @foreach($houses as $house)
                <tr>
                    <td>{{ $house->site }} {{ $house->site_socr }}</td>
                    <td>{{ $house->street }} {{ $house->street_socr }}.</td>
                    <td>{{ $house->houses_numbers }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $houses->links() }}
    @endcomponent
@endsection