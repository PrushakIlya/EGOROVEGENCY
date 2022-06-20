export const getTopGuilds = (block, url) => {
  fetch(url)
    .then(res => res.json())
    .then(body => {
      let count = 1;
      body.map(item => {
        block.innerHTML += `
      <tr>
        <td>${count++}</td>
        <td>${item.name}</td>
        <td>${item.level}</td>
      </td>
      </tr>
      `;
      });
    })
    .catch(error => console.log(error));
};

export const getTopUsers = (block, url) => {
  fetch(url)
    .then(res => res.json())
    .then(body => {
      let count = 1;
      body.map(item => {
        block.innerHTML += `<tr>
        <td><a href="/getInfo/${item.id}">${count++}</a></td>
        <td><a href="/getInfo/${item.id}">${item.name}</a></td>
        <td><a href="/getInfo/${item.id}">${item.level}</a></td>
      </tr>`;
      });
    })
    .catch(error => console.log(error));
};
