const guild_name = document.getElementById('guild_name');
const error = document.getElementById('guild_errors');
const create_guild = document.getElementById('create_guild')
const form_btn = document.getElementById('form_btn');
form_btn.addEventListener('click', e => {
  e.preventDefault();
  console.log(1)
  if (!guild_name.value.match(/^([A-Za-z0-9]{2,20})$/g)) error.innerHTML = 'Password has letters and numbers, length [2-20]';
  else error.innerHTML = '';
  if (error.textContent === '') {

    const form = document.forms.create_guild;
    form.submit();
  }
});
