<div class="container">
<div class="row justify-content-evenly">
    <div class="col-6 p-5">
        <form class="row g-3 needs-validation" wire:submit="store">

            <div class="form-group col-md-4">
                <label class="form-label">Имя</label>
                <input wire:model="firstname" type="text" class="form-control @if($errors->has('firstname')) is-invalid @endif" >
                @error('firstname') <p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">Фамилия</label>
                <input wire:model="surname" type="text" class="form-control @if($errors->has('surname')) is-invalid @endif" >
                @error('surname') <p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">Отчество</label>
                <input wire:model="lastname" type="text" class="form-control @if($errors->has('lastname')) is-invalid @endif" >
                @error('lastname') <p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="form-group col-md-4">
                <label class="form-label">Введите дату:</label>
                <input wire:model="date_born" type="date" class="form-control @if($errors->has('date_born')) is-invalid @endif" >
                @error('date_born') <p class="text-danger">{{ $message }}</p>@enderror
            </div>

            <div class="form-group col-md-8">
                <label class="form-label">Введите email</label>
                <input wire:model="email" type="text" class="form-control @if($errors->has('email')) is-invalid @endif" >
                @error('email') <p class="text-danger">{{ $message }}</p>@enderror
            </div>


                <div class="row pt-1" >
                    @foreach($inputCountryMark as $index => $countryMark)
                    <div class="form-group col-md-4" wire:key="option-field-{{$index}}">
                        <label class="form-label">Код страны: </label>
                        <select wire:model="country_mark.{{$index}}" class="form-select @if($errors->has('country_mark.' .$index)) is-invalid @endif" >
                            <option value="+375">+375</option>
                            <option value="+7">+7</option>
                        </select>
                        @error('country_mark.' .$index) <p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    @endforeach
                    @foreach($inputPhone as $index => $inputPhone)
                    <div class="form-group col-md-8" wire:key="option-field-{{$index}}">
                        <label class="form-label">Номер телефона: </label>
                        <div class="input-group">
                            <input wire:model="phone_number.{{$index}}" type="text" class="form-control @if($errors->has('phone_number.' .$index)) is-invalid @endif" id="option{{$index}}" >
                            <button wire:click="delPhone({{$index}})" class="btn btn-outline-secondary" type="button" >del</button>
                        </div>
                        @error('phone_number.' .$index) <p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    @endforeach
                </div>

                @if ($counter < 5)
                <button wire:click="addPhone" class="btn btn-outline-secondary" type="button" >Добавить телефон</button>
                @endif

            <div class="col-md-9">
                <label class="form-label">Семейное положение:</label>
                <select wire:model="family_status" class="form-select @if($errors->has('family_status')) is-invalid @endif" >
                    <option value="1" {{ old('family_status') == 1 ? 'selected' : '' }}>Холост/не замужем</option>
                    <option value="2" {{ old('family_status') == 2 ? 'selected' : '' }}>Женат/замужем</option>
                    <option value="3" {{ old('family_status') == 3 ? 'selected' : '' }}>В разводе</option>
                    <option value="4" {{ old('family_status') == 4 ? 'selected' : '' }}>Вдовец/вдова</option>
                </select>
                @error('family_status') <p class="text-danger">{{ $message }}</p>@enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Выберите файл для загрузки</label>
                <input wire:model="file.*" class="form-control @if($errors->has('file.*')) is-invalid @endif" type="file" multiple="multiple">
                @error('file.*') <p class="text-danger">{{ $message }}</p>@enderror

            </div>

            <div class="col-md-12">
                <label class="form-label">О себе</label>
                <textarea wire:model="about" class="form-control" rows="5"></textarea>
                @error('about') <p class="text-danger">{{ $message }}</p>@enderror
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input wire:click="validateForm" @if($checkbox) checked @else @endif class="form-check-input" type="checkbox">
                    <label class="form-check-label" for="invalidCheck">
                        Я ознакомился c правилами
                    </label>
                    @error('checkbox') <p class="text-danger">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="col-12">
                <button wire:click="store" class="btn btn-primary" type="submit" @if ($checkbox) @else disabled @endif>Отправить</button>
            </div>
        </form>
    </div>

</div>
</div>

