const input_repeat_pass = document.getElementById('repeat_password');
const input_pass = document.getElementById('password');
const checkName = () => {
  const error = document.getElementById('error_name');
  const input_name = document.getElementById('name');
  if (!input_name.value.match(/^([A-Za-z]{3,20})$/g)) error.innerHTML = 'NAME has only letters, length[3,20]';
  else error.innerHTML = ' ';
  fetch(`http://localhost:3000/checkDublicate/${input_name.value}`)
    .then(res => res.json())
    .then(body => {
      if (error.textContent.length == 1) {
        console.log(body)
        if (body == false) error.innerHTML = 'This Name exists';
      }
    }).catch(error=>console.log(error))
};

const checkPassword = () => {
  const error = document.getElementById('error_password');

  if (!input_pass.value.match(/^([A-Za-z0-9]{10,100})$/g)) error.innerHTML = 'Password has letters and numbers, length min 10 symbols';
  else error.innerHTML = ' ';
};

const checkRepeatPassword = () => {
  const error = document.getElementById('error_repeat_password');

  if (input_repeat_pass.value !== input_pass.value) error.innerHTML = 'Passwords are not equal';
  else error.innerHTML = ' ';
};

const form_btn = document.getElementById('form_btn');
form_btn.addEventListener('click', e => {
  e.preventDefault();
  checkName()
  checkPassword()

  const error_repeat = document.getElementById('error_repeat_password');

  if (input_repeat_pass.value !== input_pass.value) error_repeat.innerHTML = 'Passwords are not equal';
  else error_repeat.innerHTML = ' ';

  if (
    document.getElementById('error_name').textContent.length === 1 &&
    document.getElementById('error_password').textContent.length === 1 &&
    document.getElementById('error_repeat_password').textContent.length === 1
  )  document.forms.user_form.submit()
});
