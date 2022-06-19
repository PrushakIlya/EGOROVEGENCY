const block_users = document.getElementById('top_users-block')
fetch('http://localhost:3000/getTopUsers')
  .then(res => res.json())
  .then(body => {
    console.log(body)
    let count = 1;
    body.map(item => {
      block_users.innerHTML += 
      `<tr>
        <td><a href="/getInfo/${item.id}">${count++}</a></td>
        <td><a href="/getInfo/${item.id}">${item.name}</a></td>
        <td><a href="/getInfo/${item.id}">${item.level}</a></td>
      </tr>`
    }
    );
  })
  .catch(error => console.log(error));
