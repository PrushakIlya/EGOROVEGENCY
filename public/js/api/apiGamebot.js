export const win = () => {
  fetch('http://localhost:3000/win', {
    method: 'POST',
    mode: 'no-cors',
    body: JSON.stringify(arr_step),
  })
    .then(res => res.json())
    .then(body => {
      if (body) {
        localStorage.level += 1;
        localStorage.level = localStorage.getItem('level').replace(/NaN/g, '1');
        if (localStorage.getItem('level') == '111') {
          fetch('http://localhost:3000/levelUp')
            .then(res => res.ok && location.reload())
            .catch(error => console.log(error));

          localStorage.clear();
        } else {
          location.reload();
        }
      }
    })
    .catch(error => console.log(error));
};
