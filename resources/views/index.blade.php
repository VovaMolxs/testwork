<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">

    <div class="row justify-content-evenly">
        <div class="col-6 p-5">
            <form id="form" class="row g-3 needs-validation">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

                <div class="form-group col-md-4">
                    <label for="firstname" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="firstname" pattern="[A-zА-я]{3,20}" name="firstname" value="{{ old('firstname') }}" required>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="surname" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="surname" name="surname" pattern="[A-zА-я]{3,20}" value="{{ old('surname') }}" required>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="lastname" class="form-label">Отчество</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" >
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="date_born" class="form-label">Введите дату:</label>
                    <input type="date" class="form-control" id="date_born" name="date_born" value="{{ old('date_born') }}">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="form-label">Email адресс</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="row pt-1" >
                    <div class="row pt-4" id="phone_input_1">
                        <div class="form-group col-md-4">
                            <select class="form-select" id="country_mark_1" name="country_mark_1" aria-label="Default select example">
                                <option value="+375" {{ old('country_mark_1') == "+375" ? "selected" : "" }}>+375</option>
                                <option value="+7" {{ old('country_mark_1') == "+7" ? "selected" : "" }}>+7</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="phone_number_1" name="phone_number_1" value="{{ old('phone_number_1') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="addPhone" class="btn btn-outline-secondary" type="button" >Добавить телефон</button>

                <div class="col-md-9">
                    <label for="family_status" class="form-label">Семейное положение:</label>
                    <select class="form-select" id="family_status" name="family_status" required>
                        <option value="1" {{ old('family_status') == 1 ? 'selected' : '' }}>Холост/не замужем</option>
                        <option value="2" {{ old('family_status') == 2 ? 'selected' : '' }}>Женат/замужем</option>
                        <option value="3" {{ old('family_status') == 3 ? 'selected' : '' }}>В разводе</option>
                        <option value="4" {{ old('family_status') == 4 ? 'selected' : '' }}>Вдовец/вдова</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-md-12">
                    <label for="about" class="form-label">О себе</label>
                    <textarea class="form-control" name="about" id="about" rows="5">{{ old('about') }}</textarea>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-md-12">
                    <label for="formFile" class="form-label">Выберите файл для загрузки</label>
                    <input class="form-control" type="file" id="formFile" name="file_[]" multiple="multiple">
                    <div class="invalid-feedback"></div>
                </div>
                <input type="hidden" name="count_phone_number" id="count_phone_number" value="1">

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="checkbox" id="CheckBox" required>
                        <label class="form-check-label" for="invalidCheck">
                            Я ознакомился c правилами
                        </label>
                    </div>
                </div>
            </form>
            <div  class="col-12">
                <button id="btn-store" class="btn btn-primary" type="submit" disabled>Отправить</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<script src="{{ asset("js/validateFormLogin.js") }}" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
