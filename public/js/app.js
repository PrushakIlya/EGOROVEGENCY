const progress_start = document.getElementById('progress_start');
const progress_middle = document.getElementById('progress_middle');
const progress_end = document.getElementById('progress_end');
const arr_step = new Array(9);
const storage = localStorage.getItem('level');
let results = '';
let count_step = 0;

const move = id => {
  if (arr_step[id]) return false;
  const cell = document.getElementById(id);
  cell.classList.add('cross');
  cell.style.backgroundImage = "url('img/cross.svg')";
  arr_step[id] = 'cross';
  results += count_step++ + '->cross,';

  fetch('http://localhost:3000/gameBot', {
    method: 'POST',
    mode: 'no-cors',
    body: JSON.stringify(arr_step),
  })
    .then(res => res.json())
    .then(body => {
      if (Object.values(body)[0] === 'zero' || Object.values(body)[0] === 'lose') {
        results += count_step++ + '->zero,';
        const cell = document.getElementById(Object.keys(body)[0]);
        arr_step[Object.keys(body)[0]] = 'zero';
        cell.classList.add('zero');
        cell.style.backgroundImage = "url('img/zero.svg')";
      }
      switch (Object.values(body)[0]) {
        case 'win':
          {
            localStorage.level += 1;
            localStorage.level = localStorage.getItem('level').replace(/NaN/g, '1');
            if (localStorage.getItem('level') == '111') {
              fetch('http://localhost:3000/levelUp')
                .then(res => res.ok && location.reload())
                .catch(error => console.log(error));

              //API results
              fetch('http://localhost:3000/results', {
                method: 'POST',
                body: JSON.stringify(results),
              })
                .then(res => res.json())
                .catch(error => console.log(error));
              localStorage.clear();
            } else {
              location.reload();
            }
          }
          break;
        case 'lose':
          {
            fetch('http://localhost:3000/levelDown')
              .then(() => location.reload())
              .catch(error => console.log(error));

            localStorage.clear();
          }
          break;
        case 'draw':
          console.log('draw');
          location.reload();
          break;
      }
    })
    .catch(error => console.log(error));
};

//---------------------------------------------------

document.addEventListener('DOMContentLoaded', function () {
  const callback = () => {
    storage == '1' && progress_start.classList.add('progress_up');
    if (storage == '11') {
      progress_start.classList.add('progress_up');
      progress_middle.classList.add('progress_up');
    }
  };
  let observer = new MutationObserver(callback);

  const elem = document.querySelector('body');

  observer.observe(elem, {
    childList: true,
    subtree: true,
  });
});

const account = document.getElementById('account_level');
if (account.textContent > 2 || account.textContent == 2) {
  document.getElementById('upload_form').style.display = 'flex';
}
if (account.textContent > 3 || account.textContent == 3) {
  document.getElementById('create_guild').style.display = 'flex';
}

if (document.getElementById('create_guild').style.display == 'flex') {
  fetch('http://localhost:3000/checkLeader')
    .then(res =>res.json())
    .then(body => {
      if (body[0].guild_id !== null) {
        document.getElementById('create_guild').textContent = 'Management Guild';
        document.getElementById('create_guild').href = '/managementGuild';
      }
    });
}
