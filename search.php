<?php
// Replace with your own API key
$api_key = "9fadbd1d-dffd-4c9d-ac76-d1e830068324";

// Get the player's name from the request parameter
$username = $_GET["username"];

// Set up the API request URL
$url = "https://fortnite-api.com/v1/stats/br/v2?name=$username";

// Set up cURL to make the API request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: $api_key"
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Send the API request and get the response
$response = curl_exec($ch);
curl_close($ch);

// Parse the JSON response into a PHP object
$data = json_decode($response);

// Check if there was an error retrieving the player's stats
if (isset($data->error)) {
  echo "There was an error retrieving the player's stats.";
} else {
  // Extract the player's epic ID from the response
  $epic_id = $data->data->account->id;

  // Display the player's epic ID
  echo "Player $username has Epic ID $epic_id.";
}
?>
