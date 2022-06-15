const arr = new Array(9);
let result = '';
let count = 0;
const storage = localStorage.getItem('level');

const move = id => {
  if (arr[id]) return false;
  const cell = document.getElementById(id);
  cell.classList.add('cross');
  cell.style.backgroundImage = "url('img/cross.svg')";
  arr[id] = 'cross';
  result += count + '+cross/';
  zero();
  if (win()) {
    localStorage.level += 1;
    localStorage.level = localStorage.getItem('level').replace(/NaN/g, '1');
    if (localStorage.getItem('level') == '111') {
      fetch('http://localhost:3000/gameResult')
        .then(res => res.ok && location.reload())
        .catch(error => console.log(error));

      localStorage.clear();
    } else {
      location.reload();
    }
  }
  draw();
};

const win = () => {
  if (arr[0] === 'cross' && arr[1] === 'cross' && arr[2] === 'cross') return true;
  if (arr[3] === 'cross' && arr[4] === 'cross' && arr[5] === 'cross') return true;
  if (arr[6] === 'cross' && arr[7] === 'cross' && arr[8] === 'cross') return true;
  if (arr[0] === 'cross' && arr[4] === 'cross' && arr[8] === 'cross') return true;
  if (arr[2] === 'cross' && arr[4] === 'cross' && arr[6] === 'cross') return true;
  if (arr[0] === 'cross' && arr[3] === 'cross' && arr[6] === 'cross') return true;
  if (arr[1] === 'cross' && arr[4] === 'cross' && arr[7] === 'cross') return true;
  if (arr[2] === 'cross' && arr[5] === 'cross' && arr[8] === 'cross') return true;
  return false;
};

const lose = () => {
  if ((arr[0] === 'cross' && arr[1] === 'cross' && arr[2] === 'cross') || (arr[0] === 'zero' && arr[1] === 'zero' && arr[2] === 'zero')) return true;
  if ((arr[3] === 'cross' && arr[4] === 'cross' && arr[5] === 'cross') || (arr[3] === 'zero' && arr[4] === 'zero' && arr[5] === 'zero')) return true;
  if ((arr[6] === 'cross' && arr[7] === 'cross' && arr[8] === 'cross') || (arr[6] === 'zero' && arr[7] === 'zero' && arr[8] === 'zero')) return true;
  if ((arr[0] === 'cross' && arr[4] === 'cross' && arr[8] === 'cross') || (arr[0] === 'zero' && arr[4] === 'zero' && arr[8] === 'zero')) return true;
  if ((arr[2] === 'cross' && arr[4] === 'cross' && arr[6] === 'cross') || (arr[2] === 'zero' && arr[4] === 'zero' && arr[6] === 'zero')) return true;
  if ((arr[0] === 'cross' && arr[3] === 'cross' && arr[6] === 'cross') || (arr[0] === 'zero' && arr[3] === 'zero' && arr[6] === 'zero')) return true;
  if ((arr[1] === 'cross' && arr[4] === 'cross' && arr[7] === 'cross') || (arr[1] === 'zero' && arr[4] === 'zero' && arr[7] === 'zero')) return true;
  if ((arr[2] === 'cross' && arr[5] === 'cross' && arr[8] === 'cross') || (arr[2] === 'zero' && arr[5] === 'zero' && arr[8] === 'zero')) return true;
  return false;
};

const zero = () => {
  const step = Math.floor(Math.random() * 9);
  if (!arr[step]) {
    arr[step] = 'zero';
    result += count + '+zero/';
    const cell = document.getElementById(step);
    cell.classList.add('zero');
    cell.style.backgroundImage = "url('img/zero.svg')";
  } else {
    zero();
  }
};

const draw = () => {
  let count = 0;
  for (let index = 0; index < arr.length; index++) {
    arr[index] && count++;
  }
  count === 8 && location.reload();
};

//---------------------------------------------------

document.addEventListener('DOMContentLoaded', function () {
  const callback = (mutations, observer) => {
    console.log(mutations);
    const progress_start = document.getElementById('progress_start');
    const progress_middle = document.getElementById('progress_middle');
    const progress_end = document.getElementById('progress_end');
    storage == '1' && progress_start.classList.add('progress_up');
    if (storage == '11') {
      progress_start.classList.add('progress_up');
      progress_middle.classList.add('progress_up');
    }
    if (storage == '111') {
      progress_start.classList.add('progress_up');
      progress_middle.classList.add('progress_up');
      progress_end.classList.add('progress_up');
    }
  };
  let observer = new MutationObserver(callback);

  const elem = document.querySelector('body');

  observer.observe(elem, {
    childList: true,
    subtree: true,
    subtree: true,
  });
});

const account = document.getElementById('account_level');
if (account.textContent > 2 || account.textContent == 2) {
  document.getElementById('upload_avatar').hidden = false;
}
