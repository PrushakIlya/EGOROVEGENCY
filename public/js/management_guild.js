fetch('http://localhost:3000/inGuild')
  .then(res => res.json())
  .then(body => {
    body.map(item => {
      document.getElementById('btn_' + item['id']).classList = 'btn_disabled';
      document.getElementById('btn_' + item['id']).disabled = 'true';
      document.getElementById('info_' + item['id']).textContent = 'in your guild';
    });
  });

const invitation = (id, guild) => {
  fetch('http://localhost:3000/sendInvitation', {
    method: 'POST',
    body: JSON.stringify({ user_id: id, guild_id: guild }),
  })
    .then(() => {
      fetch('http://localhost:3000/checkInvitations')
        .then(res => res.json())
        .then(body => {
          console.log(body);
          body.map(item => {
            console.log(item);
            document.getElementById('btn_' + item['user_id']).classList = 'btn_disabled';
            document.getElementById('btn_' + item['user_id']).disabled = 'true';
            document.getElementById('info_' + item['user_id']).textContent = 'sended a invitation';
          });
        });
    })
    .catch(error => console.log(error));
};

fetch('http://localhost:3000/checkInvitations')
  .then(res => res.json())
  .then(body => {
    console.log(body);
    body.map(item => {
      console.log(item);
      document.getElementById('btn_' + item['user_id']).classList = 'btn_disabled';
      document.getElementById('btn_' + item['user_id']).disabled = 'true';
      document.getElementById('info_' + item['user_id']).textContent = 'sended a invitation';
    });
  });
