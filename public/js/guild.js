const guild_name = document.getElementById('guild_name');
const guild_parent = document.getElementById('guild_parent');
const errors_name = document.getElementById('guild-errors_name');
const errors_parent = document.getElementById('guild-errors_parent');
const create_guild = document.getElementById('create_guild');
const form_btn = document.getElementById('form_btn');
const form = document.forms.create_guild;

guild_name.oninput = function () {
  if (!guild_name.value.match(/^([A-Za-z0-9]{2,20})$/g)) errors_name.innerHTML = 'Name has letters and numbers, length [2-20]';
  else errors_name.innerHTML = '';
};
guild_parent.oninput = function () {
  if (guild_parent.value) {
    fetch('http://localhost:3000/checkParent', {
      method: 'POST',
      body: JSON.stringify(guild_parent.value),
    })
      .then(res => res.json())
      .then(body => {
        if (!body) errors_parent.innerHTML = 'Parrent does not exist';
        else errors_parent.innerHTML = '';
      })
      .catch(error => console.log(error));
  } else errors_parent.innerHTML = '';
};

form_btn.addEventListener('click', e => {
  e.preventDefault();
  if (errors_parent.textContent === '' && errors_name.textContent === '') form.submit();
});
