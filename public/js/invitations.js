fetch('http://localhost:3000/invitations')
  .then(res => res.json())
  .then(body => {
    body.map(item => {
      document.getElementById('popap_block').innerHTML += `
        <div id = 'popap_${item['user_id']}'>
            <h2>invite From Guild: ${item['name']}</h2>
            <button class="btn" id="reject" >Reject</button>
            <button class="btn" id="accept" onclick="accept(${item['user_id']},${item['id']})">Accept</button>
        </div>
        `;
    });
  })
  .catch(error => console.log(error));

const accept = (user_id, guild_id) => {
  fetch('http://localhost:3000/acceptInvite', {
    method: 'POST',
    body: JSON.stringify({ user_id: user_id, guild_id: guild_id }),
  })
    .then(res => {
      res.ok && document.getElementById('popap_' + user_id).remove();
    })
    .catch(error => console.log(error));
};
