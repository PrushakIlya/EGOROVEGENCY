const input_name = document.getElementById('name');
const input_pass = document.getElementById('password');

const error_pass = document.getElementById('error_password');
const error_name = document.getElementById('error_name');

input_name.oninput = function () {
  if (!input_name.value.match(/^([A-Za-z]{3,20})$/g)) error_name.innerHTML = 'NAME has only letters, length[3,20]';
  else error_name.innerHTML = ' ';
};

input_pass.oninput = function () {
  if (!input_pass.value.match(/^([A-Za-z0-9]{10,100})$/g)) error_pass.innerHTML = 'Password has letters and numbers, length min 10 symbols';
  else error_pass.innerHTML = ' ';
};

const form_btn = document.getElementById('form_btn');
form_btn.addEventListener('click', e => {
  e.preventDefault();
  if (error_pass.textContent === '' && error_name.textContent === '') {
    if (!input_name.value.match(/^([A-Za-z]{3,20})$/g)) error_name.innerHTML = 'NAME has only letters, length[3,20]';
    if (!input_pass.value.match(/^([A-Za-z0-9]{10,100})$/g)) error_pass.innerHTML = 'Password has letters and numbers, length min 10 symbols';
  }
  if (!input_name.value.match(/^([A-Za-z]{3,20})$/g)) error_name.innerHTML = 'NAME has only letters, length[3,20]';
  if (!input_pass.value.match(/^([A-Za-z0-9]{10,100})$/g)) error_pass.innerHTML = 'Password has letters and numbers, length min 10 symbols';
  else error_pass.innerHTML = ' ';
  if (error_name.textContent.length == 1 && error_pass.textContent.length == 1) {
    fetch('http://localhost:3000/autorizationCheck', {
      method: 'POST',
      body: JSON.stringify([input_name.value, input_pass.value]),
    })
      .then(res => res.json())
      .then(body => {
        if (body === false) error_name.innerHTML = 'Try again please';
        else location.replace('/game');
      })
      .catch(error => console.log(error));
  }
});
