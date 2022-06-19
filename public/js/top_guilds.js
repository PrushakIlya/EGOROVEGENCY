const block_guilds = document.getElementById('top_guilds-block')
fetch('http://localhost:3000/getTopGuilds')
  .then(res => res.json())
  .then(body => {
    let count = 1;
    body.map(item => {
      block_guilds.innerHTML += `
      <tr>
        <td>${count++}</td>
        <td>${item.name}</td>
        <td>${item.level}</td>
      </td>
      </tr>
      `
    }
    );
  })
  .catch(error => console.log(error));

