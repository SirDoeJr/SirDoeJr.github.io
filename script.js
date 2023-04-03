const form = document.querySelector('form');
const username = document.querySelector('#username');
const results = document.querySelector('#results');

form.addEventListener('submit', (event) => {
  event.preventDefault();
  
  const xhr = new XMLHttpRequest();
  const url = `search.php?username=${username.value}`;

  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        results.innerHTML = xhr.responseText;
      } else {
        results.innerHTML = `Error: ${xhr.status} ${xhr.statusText}`;
      }
    }
  }

  xhr.open('GET', url);
  xhr.send();
});
