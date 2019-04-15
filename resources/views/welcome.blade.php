@extends('layouts.app')

@section('title')
    Отчеты
@endsection

@section('content')
    @component('components.panel')
        <ul>
            <li><a href="{{ route('report-1') }}">Дом, количество проживающих для домов с чётными номерами</a></li>
            <li><a href="{{ route('report-2') }}">Фамилия, № дома, № Паспорта</a></li>
            <li><a href="{{ route('report-3') }}">Город, улица, № дома (для пустующих домов)</a></li>
            <li><a href="{{ route('index') }}">Почтовый индекс, Код ИФНС, Код ОКАТО (для заданного адреса)</a></li>
        </ul>
    @endcomponent
@endsection