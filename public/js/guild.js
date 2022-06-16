const guild_name = document.getElementById('guild_name');
const error = document.getElementById('guild_errors');
const create_guild = document.getElementById('create_guild');
const form_btn = document.getElementById('form_btn');
const form = document.forms.create_guild;

guild_name.oninput = function () {
  if (!guild_name.value.match(/^([A-Za-z0-9]{2,20})$/g)) error.innerHTML = 'Password has letters and numbers, length [2-20]';
  else error.innerHTML = '';
};

form_btn.addEventListener('click', e => {
  e.preventDefault();
  if (error.textContent === '') form.submit();
});

