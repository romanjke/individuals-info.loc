@extends('layouts.app')

@section('title')
    Отчет №2: &laquo;ФИО, № дома, № Паспорта&raquo;
@endsection

@section('content')
    @component('components.panel')
        <table class='table'>
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>№ дома</th>
                    <th>№ Паспорта</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->fio }}</td>
                    <td>{{ $item->house }}</td>
                    <td>{{ $item->passport }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    @endcomponent
@endsection