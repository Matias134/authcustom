const username = document.querySelector('#username');
const email = document.querySelector('#email');
const dateOfBirth = document.querySelector('#dateOfBirth');
const age = document.querySelector('#age');
const btnLogout = document.querySelector('#btn-logout');

$(document).ready(function () {
    $.ajax({
        url: route('user.getUser'),
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            username.textContent = data.name;
            email.textContent = data.email;
            dateOfBirth.textContent = data.dateOfBirth;
            age.textContent = data.age + ' años';
        },
        error: function (error) {
            if (error.status === 500) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.message,
                })
            }
        }
    });
});

btnLogout.addEventListener('click', () => {
    logout();
})

const logout = () => {
    $.ajax({
        url: route('user.logout'),
        type: 'GET',
        success: function (data) {
            if (data.message === 'Cerrar sesion') {
                window.location.href = route('user.login');
            }
        },
        error: function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ha ocurrido un error al mostrar los datos',
            })
        }
    });
};
