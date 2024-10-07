@extends('layouts.app')

@section('title', 'Профиль')

@php
    $user = auth()->user();

    $group = auth()->user()->reader->group_code;
@endphp

@section('content')
    <div class="section">
        <form>
            <div class="form-row">
                <div class="form-input">
                    <label for="login">Логин</label>
                    <input type="text" id="login" name="login" value="{{ auth()->user()->login }}">
                </div>
                <div class="form-input">
                    <label for="email">Почта</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->reader->email }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-input">
                    <label for="phone">Номер телефона</label>
                    <input type="tel" id="phone" name="phone" value='{{ auth()->user()->reader->phone }}'>
                </div>
                <div class="form-input">
                    <label for="group">Группа</label>
                    <input type="text" id="group" name="group" value="{{ $group ?? '-' }}" disabled>
                </div>
            </div>
            <div class="button-row">
                <button type="button">Сохранить</button>
            </div>
        </form>
    </div>

    <div class="section">
        <form>
            <div class="form-row">
                <div class="form-input">
                    <label for="old-pass">Старый пароль</label>
                    <input type="password" id="old-pass" name="old-pass">
                </div>
                <div class="form-input">
                    <label for="new-pass">Новый пароль</label>
                    <input type="password" id="new-pass" name="new-pass">
                </div>
            </div>
            <div class="button-row">
                <button type="button">Изменить пароль</button>
            </div>
        </form>
    </div>
@endsection
