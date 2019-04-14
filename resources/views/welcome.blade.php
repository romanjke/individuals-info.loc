@extends('layouts.app')

@section('title')
    Список отчетов
@endsection

@section('content')
    @component('components.panel')
        <ul>
            <li><a href="{{ route('report-1') }}" target="_blank">Дом, количество проживающих для домов с чётными номерами</a></li>
            <li><a href="{{ route('index') }}" target="_blank">Фамилия, № дома, № Паспорта</a></li>
            <li><a href="{{ route('index') }}" target="_blank">Город, улица, № дома (для пустующих домов)</a></li>
            <li><a href="{{ route('index') }}" target="_blank">Почтовый индекс, Код ИФНС, Код ОКАТО (для заданного адреса)</a></li>
        </ul>
    @endcomponent
@endsection