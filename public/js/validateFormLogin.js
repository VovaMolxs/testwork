
    let form = document.getElementById('form');
    let firstname = document.getElementById('firstname');
    let surname = document.getElementById('surname');
    let lastname = document.getElementById('lastname');
    let date_born = document.getElementById('date_born');
    let email = document.getElementById('email');
    let family_status = document.getElementById('family_status');
    let about = document.getElementById('about');
    let formFile = document.getElementById('formFile');
    let button = document.getElementById('btn-store');
    let checkBox = document.getElementById('CheckBox');
    let resultCheck = [];


    let setError = (element, message) => {

        let inputControl = element;
        let errorDisplay = element.parentElement.querySelector('.invalid-feedback');
        console.log(element)
        resultCheck.push(false);

        errorDisplay.innerText = message;
        inputControl.classList.add('is-invalid');
        inputControl.classList.remove('is-valid');
    }

    let setSuccess = element => {
        let inputControl = element;
        let errorDisplay = inputControl.parentElement.querySelector('.invalid-feedback');
        resultCheck.push(true);

        errorDisplay.innerText = '';
        inputControl.classList.add('is-valid');
        inputControl.classList.remove('is-invalid');
}



    let validateInputs = () => {
    let firstnameValue = firstname.value.trim();
    let surnameValue = surname.value.trim();
    let lastnameValue = lastname.value.trim();
    let date_bornValue = date_born.value.trim();
    let emailValue = email.value.trim();
    let family_statusValue = family_status.value.trim();
    let aboutValue = about.value.trim();

    //регулярка для текстовых полей
    let regFirstName = /[А-яA-z]{3,20}/g;
    let regSurName = /[А-яA-z]{3,20}/g;
    let regLastName = /[А-яA-z]{0,20}/g;
    let regDate = /[0-9]{4}-[0-9]{2}-[0-9]{2}/g;
    let emailReg = /^(([^<>()\/[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
    let regPhone = /[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2}/gm;

    (regFirstName.test(firstnameValue)) ? setSuccess(firstname) : setError(firstname, 'Имя должно быть от 3 до 20 символов');
    (regSurName.test(surnameValue)) ? setSuccess(surname) : setError(surname, 'Фамилия должно быть от 3 до 20 символов');
    (regLastName.test(lastnameValue)) ? setSuccess(lastname) : setError(lastname, 'Отчество поле может быть пустым или длинной до 20 символов');
    (regDate.test(date_bornValue)) ? setSuccess(date_born) : setError(date_born, 'Выберите дату рождения');

    if (emailValue == '' && document.getElementById('phone_number_1').value.trim() == '') {
        setError(email, 'Поле email или телефон надо заполнить!');
    }

    if (document.getElementById('phone_number_1').value.trim() !== '') {

        let counter = newIndex;
            while(counter > 0) {
            let phone_number = document.getElementById('phone_number_' + counter);
                console.log(phone_number.value);
                if(regPhone.test(phone_number.value.trim())) {
                    setSuccess(phone_number)
                } else {
                    setError(phone_number, 'Проверьте номер телефона');
                }
                counter--;
        }
    }
    if (emailValue !== '') {
    (emailReg.test(emailValue)) ? setSuccess(email) : setError(email, 'Проверьте введеный email');
}


    (family_statusValue !== '') ? setSuccess(family_status): setError(family_status, 'Выберите семейный статус');
    (aboutValue.length <= 1000) ? setSuccess(about): setError(about, 'Максимум 1000 символов');
    (document.getElementById("formFile").files.length > 0 && document.getElementById("formFile").files.length < 6) ? setSuccess(formFile) : setError(formFile, "От 1 до 5 файлов включительно") ;

}

    $(document).ready(function() {
        $("input:checkbox").on("change", function() {
            $('.reg').slideToggle();
        });
    });

    $(document).ready(function() {
        $('#form').keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    let newIndex = 1;
    $(document).ready(function() {
        $('#addPhone').click(function(event) {
            if (newIndex < 5) {
                newIndex++;
                let clonePhone = $("#phone_input_1").clone(true);
                clonePhone.find('#phone_input_1').attr('id', 'phone_input_'+newIndex);
                clonePhone.find('#country_mark_1').attr({
                    'id': 'country_mark_'+newIndex,
                    'name': 'country_mark_'+newIndex,
                });
                clonePhone.find('#phone_number_1').attr({
                    'id': 'phone_number_'+newIndex,
                    'name': 'phone_number_'+newIndex,
                    'class': 'form-control',
                });
                clonePhone.find("input[type=text]").val("");

                clonePhone.appendTo(".row .pt-1");
            }
            if (newIndex > 4) {
                $('#addPhone').remove()
            }

        });
    });

    $(document).ready(function() {
        $("#CheckBox").change(function() {
            if(this.checked) {
                console.log("checked")
                resultCheck.length = 0;
                validateInputs();
                console.log(resultCheck)
                console.log(resultCheck.includes(false))
                if (!resultCheck.includes(false)) {
                    button.removeAttribute('disabled')
                }
            } else {
                console.log("uncheked");
            }
        });
    });

    /*
        $(document). ready(function() {
            $('#del_phone').click(function() {
               $(this).parents('.pt-4').remove();
            });
        })
    */

    $(document).ready(function () {
        $('button#btn-store').on('click', function () {

            var formData = new FormData(form);


            $.ajax({
                type: "POST",
                url: 'store',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                dataType : 'json',
                success: function(response){
                    response = JSON.parse(JSON.stringify(response))
                    console.log(response)

                    $('div.container').empty()
                    $('div.container').html(`<div class="alert alert-success mt-5" role="alert">
                                              <h4 class="alert-heading">Успешно!</h4>
                                              <p>Ваши данные были успешно добавленные в систему!</p>
                                              <hr>
                                              <p class="mb-0">Имя: ${response.firstname}</p>
                                              <p class="mb-0">Фамилия: ${response.surname}</p>
                                              <p class="mb-0">Отчество: ${response.lastname}</p>
                                              <p class="mb-0">Телефон: ${response.user_phone}</p>
                                              <p class="mb-0">Email: ${response.email}</p>
                                              <p class="mb-0">Файлы: ${response.files}</p>
                                              <p class="mb-0">Семейный статус: ${response.family_status}</p>
                                              <p class="mb-0">О себе: ${response.about}</p>
                                              <p class="mb-0">Дата рождения: ${response.date_born}</p>

                                            </div>`);




                },
                error: function(error) {
                    error = JSON.parse(error.responseText);
                    console.error("error")
                    console.log(error)
                }
            })

        })
    })
