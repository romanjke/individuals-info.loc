@extends('layouts.app')

@section('title')
    Отчет №1: &laquo;Дом, количество проживающих для домов с чётными номерами&raquo;
@endsection

@section('content')
    @component('components.panel')
        <table class='table'>
            <thead>
                <tr>
                    <th>№ дома</th>
                    <th>Количество проживающих</th>
                </tr>
            </thead>
            <tbody>
                @foreach($houses as $house)
                <tr>
                    <td>{{ $house->house }}</td>
                    <td>{{ $house->cnt }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $houses->links() }}
    @endcomponent
@endsection