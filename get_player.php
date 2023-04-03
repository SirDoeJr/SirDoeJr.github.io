<?php
// Replace with your own API key
$api_key = "9fadbd1d-dffd-4c9d-ac76-d1e830068324";

// Get the player's username from the POST request
$username = $_POST["username"];

// Set up the request URL
$url = "https://fortnite-api.com/v1/stats/br/v2/?name=$username";

// Set up the cURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: $api_key"
));

// Execute the request and decode the response
$response = curl_exec($ch);
$data = json_decode($response);

// Check if the response contains errors
if ($data->status == 404) {
    echo "<h2>Player not found!</h2>";
} elseif ($data->status == 200) {
    // Extract the relevant player information
    $username = $data->data->account->name;
    $epic_id = $data->data->account->id;
    $platform = $data->data->account->platform->name;
    $lifetime_stats = $data->data->stats->all;
    
    // Display the player information
    echo "<h2>Player information:</h2>";
    echo "<p>Username: $username</p>";
    echo "<p>Epic ID: $epic_id</p>";
    echo "<p>Platform: $platform</p>";
    echo "<h3>Lifetime stats:</h3>";
    foreach ($lifetime_stats as $stat) {
        echo "<p>$stat->name: $stat->value</p>";
    }
} else {
    echo "<h2>Something went wrong!</h2>";
}

// Close the cURL session
curl_close($ch);
?>
