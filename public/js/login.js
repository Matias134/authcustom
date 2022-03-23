const email = document.querySelector('#email');
const password = document.querySelector('#password');
const btnLogin = document.querySelector('#btn-login');

//Errors
const errors = document.querySelectorAll('.error');
const errorEmail = document.querySelector('#error-email');
const errorPassword = document.querySelector('#error-password');

btnLogin.addEventListener('click', (e) => {
    e.preventDefault();
    login();
})

email.addEventListener('keyup', () =>{
    disabledButton( email.value, password.value )
})

password.addEventListener('keyup', () =>{
    disabledButton( email.value, password.value )
})

const login = () => {
    clearErrors( errors );
    $.ajax({
        url: route('user.login'),
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            email: email.value,
            password: password.value
        },
        success: function( data ){
            if(data.message === "Iniciar sesion"){
                window.location.href = route('main.welcome');
            }
        },
        error: function( error ){
            const errors = error.responseJSON;
            if(error.status === 400){
                if(errors.email){
                    errorEmail.textContent = errors.email;
                }
                if(errors.password){
                    errorPassword.textContent = errors.password;
                }
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

const disabledButton = ( email, password ) => {
    if(email.length > 0 && password.length > 0) {
        btnLogin.removeAttribute("disabled");
    } else {
        btnLogin.setAttribute('disabled', true);
    }
}

const clearErrors = ( errors ) => {
    [...errors].map( error => {
        error.textContent = '';
    })
}