const username = document.querySelector('#username');
const email = document.querySelector('#email');
const dateOfBirth = document.querySelector('#dateOfBirth');
const password = document.querySelector('#password');
const btnRegister = document.querySelector('#btn-register');

//Errors
const errors = document.querySelectorAll('.error');
const errorUsername = document.querySelector('#error-username');
const errorEmail = document.querySelector('#error-email');
const errorDateOfBirth = document.querySelector('#error-dateOfBirth');
const errorPassword = document.querySelector('#error-password');


btnRegister.addEventListener('click', (e) => {
    e.preventDefault();
    register();
})

const register = () => {

    clearErrors( errors );

    $.ajax({
        url: route('user.store'),
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            username: username.value,
            email: email.value,
            dateOfBirth: dateOfBirth.value,
            password: password.value
        },
        success: function( data ){
            if( data.message == 'Usuario creado' ){
                window.location.href = route('main.welcome');
            }
        },
        error: function( error ){
            if(error.status === 422){
                const errors = error.responseJSON.errors;
                if(errors.username){
                    errorUsername.textContent = errors.username[0];
                }
                if(errors.email){
                    errorEmail.textContent = errors.email[0];
                }
                if(errors.dateOfBirth){
                    errorDateOfBirth.textContent = errors.dateOfBirth[0];
                }
                if(errors.password){
                    errorPassword.textContent = errors.password[0];
                }
            }
            if(error.status === 400){
                errorDateOfBirth.textContent = error.responseJSON.message;
            }
            if(error.status === 500){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.message,
                  })
            }
        }
    });
}

const clearErrors = ( errors ) => {
    [...errors].map( error => {
        error.textContent = '';
    })
}