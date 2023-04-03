function getEpicId() {
  var apiKey = '9fadbd1d-dffd-4c9d-ac76-d1e830068324'; // Replace with your API key
  var username = document.getElementById('username').value;
  var url = 'https://fortnite-api.com/v2/users/id?username=' + username;
  fetch(url, {headers: {'Authorization': apiKey}})
    .then(response => response.json())
    .then(data => {
      if (data.status === 200) {
        var epicId = data.data.accountId;
        document.getElementById('epic-id').innerHTML = 'Epic ID: ' + epicId;
      } else {
        document.getElementById('epic-id').innerHTML = 'Error retrieving Epic ID';
      }
    });
}
