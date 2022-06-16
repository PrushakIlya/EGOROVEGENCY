const checkDublicat = (url) =>{
  fetch(url)
    .then(res => res.json())
    .then(body => {
      if (error.textContent.length == 1) {
        console.log(body);
        if (body == false) error.innerHTML = 'This Name exists';
      }
    })
    .catch(error => console.log(error));
}

export default checkDublicat;

