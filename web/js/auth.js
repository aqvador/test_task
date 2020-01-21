$('.form').find('input, textarea').on('keyup blur focus', function (e) {

    var $this = $(this),
        label = $this.prev('label');

    if (e.type === 'keyup') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.removeClass('highlight');
        }
    } else if (e.type === 'focus') {

        if ($this.val() === '') {
            label.removeClass('highlight');
        } else if ($this.val() !== '') {
            label.addClass('highlight');
        }
    }

});

$('.tab a').on('click', function (e) {

    e.preventDefault();

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(600);

});

/**
 * Валидатор авторизации
 */
$(function () {
    $("#FormLogin").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            pass: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            email: {
                required: "Поле email обязательно.",
                email: jQuery.validator.format("Не корректный <br> Например: nama@exemple.ru")
            },
            pass: {
                required: "Поле пароль обязательно.",
                minlength: jQuery.validator.format("Длина пароля должна быть больше 5-ти символов")
            }
        },
        submitHandler: function () {
            var data = {};
            $('#FormLogin').find('input, button').each(function () {
                data[this.name] = $(this).val();
            });
            $.ajax({
                url: "/user/login",
                type: "POST",
                dataType: "json",
                data: data,
                success: function (data) {
                    if (data.status !== true) {
                        return false;
                    }
                    $('input').val('');
                    setTimeout(function () {
                        $(location).attr('href', '/');
                    }, 500);
                }
            });
        }
    });
});

/**
 * Валидация Формы регистрации
 */
$("#formSignUp").validate({
    rules: {
        name: {
            required: true,
            minlength: 2
        },
        lastName: {
            required: true,
            minlength: 2
        },
        email: {
            rangelength: [6, 45],
            required: true,
            email: true,
            remote: {
                url: "/user/validation/check-email",
                type: "POST"
            }
        },
        phone: {
            required: true,
            rangelength: [11, 11],
            digits: true
        },
        password: {
            required: true,
            minlength: 6
        },
        confirmPassword: {
            required: true,
            minlength: 6,
            equalTo: ".password"
        }
    },

    messages: {
        name: {
            required: "Поле Имя обязательно.",
            minlength: "Минимальная длинна {0} символа",
        },
        lastName: {
            required: "Поле Фамилия обязательно.",
            minlength: "Минимальная длинна {0} символа",
        },
        email: {
            required: "Поле Email обязательно.",
            email: jQuery.validator.format("Не корректный Email"),
            remote: "Email {0} уже занят",
            rangelength: "Длинна email от {0}  до {1} символов"
        },
        password: {
            required: "Поле Пароль обязательно.",
            minlength: jQuery.validator.format("Минимальная длинна пароля  {0} символов")
        },
        confirmPassword: {
            required: "Это обязательное поле",
            minlength: jQuery.validator.format("Минимальная длинна пароля  {0} символов"),
            equalTo: "Пароли не совпадают"
        }
    },
    submitHandler: function () {
        var data = {};
        $('#formSignUp').find('input, button').each(function () {
            data[this.name] = $(this).val();
        });
        $.ajax({
            url: "/ajax/Authorization/registr",
            type: "POST",
            dataType: "json",
            data: data,
            success: function (data) {
                AlertSwal(data);
                if (data.status !== true) {
                    return false;
                }
                $('input').val('');
                $('.tab-group').find('li').each(function () {
                    $(this).toggleClass('active');
                });
                $('.tab-content > div').not('#login').hide();
                $('#login').fadeIn(600);
            }
        });
    }
});