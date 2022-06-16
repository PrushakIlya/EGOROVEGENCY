// import checkDublicat from './api.js'
// import {CHECKDUBLICATE} from './api-type.js'

const input_repeat_pass = document.getElementById('repeat_password');
const input_pass = document.getElementById('password');
const input_name = document.getElementById('name');

input_name.oninput = function () {
  const error = document.getElementById('error_name');
  if (!input_name.value.match(/^([A-Za-z]{3,20})$/g)) error.innerHTML = 'NAME has only letters, length[3,20]';
  else error.innerHTML = ' ';
  // checkDublicat(`http://localhost:3000/checkDublicate/${input_name.value}`)
  fetch(`http://localhost:3000/checkDublicate/${input_name.value}`)
    .then(res => res.json())
    .then(body => {
      if (error.textContent.length == 1) {
        console.log(body);
        if (body == false) error.innerHTML = 'This Name exists';
      }
    })
    .catch(error => console.log(error));
};

input_pass.oninput = function () {
  const error = document.getElementById('error_password');
  if (!input_pass.value.match(/^([A-Za-z0-9]{10,100})$/g)) error.innerHTML = 'Password has letters and numbers, length min 10 symbols';
  else error.innerHTML = ' ';
};

input_repeat_pass.oninput = function () {
  const error = document.getElementById('error_repeat_password');
  if (input_repeat_pass.value !== input_pass.value) error.innerHTML = 'Passwords are not equal';
  else error.innerHTML = ' ';
};

const form_btn = document.getElementById('form_btn');
form_btn.addEventListener('click', e => {
  e.preventDefault();
  document.getElementById('error_name').textContent.length === 1 &&
    document.getElementById('error_password').textContent.length === 1 &&
    document.getElementById('error_repeat_password').textContent.length === 1 &&
    document.forms.user_form.submit();
});
