@extends('layouts.app')

@section('title')
    Отчет №4: &laquo;Почтовый индекс, Код ИФНС, Код ОКАТО для заданного адреса&raquo;
@endsection

@section('content')
    @component('components.panel')
        <table class='table'>
            <thead>
                <tr>
                    <th>Город</th>
                    <th>Улица</th>
                    <th>Интервал домов</th>
                    <th>Почтовый индекс</th>
                    <th>Код ИФНС</th>
                    <th>Код ОКАТО</th>
                </tr>
            </thead>
            <tbody>
                @foreach($housesCodes as $item)
                <tr>
                    <td>{{ $item->site }} {{ $item->site_socr }}.</td>
                    <td>{{ $item->street }} {{ $item->street_socr }}.</td>
                    <td>{{ $item->houses }}</td>
                    <td>{{ $item->index }}</td>
                    <td>{{ $item->gninmb }}</td>
                    <td>{{ $item->ocatd }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $housesCodes->links() }}
    @endcomponent
@endsection