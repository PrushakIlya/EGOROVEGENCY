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
  if (error_name.textContent.length == 1 && error_pass.textContent.length == 1) {
    const form = document.forms.user_form;
    form.submit();
  }
});
