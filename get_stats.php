<?php
// Replace <YOUR_API_KEY> with your actual Fortnite Tracker API key
$api_key = 'c24c53c9-ceae-4ef4-9a6a-fe38e5555301';
$username = $_GET['username'];
$url = "https://api.fortnitetracker.com/v1/profile/all/{$username}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'TRN-Api-Key: ' . $api_key
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);

if (isset($data->error)) {
	echo '<p>There was an error retrieving the account information.</p>';
} else {
	$account_id = $data[0]->accountId;
	$username = $data[0]->epicUserHandle;
	$platform = $data[0]->platformNameLong;
	$picture_url = $data[0]->avatar;
	$favorite_games = $data[0]->favoriteMode;
	$library_games = $data[0]->played;

	echo '<div class="account-info">';
	echo "<img src='{$picture_url}' alt='Profile picture' class='profile-picture'>";
	echo "<h2 class='account-id'>Account ID: {$account_id}</h2>";
	echo "<h3 class='username'>Username: {$username}</h3>";
	echo "<p class='favorite-games'><strong>Favorite Games:</strong> {$favorite_games}</p>";
	echo '<ul class="favorite-games-list">';
	foreach ($data[0]->stats->favorites as $favorite) {
		echo "<li>{$favorite->metadata->name} - {$favorite->value}</li>";
	}
	echo '</ul>';
	echo "<p class='library-games'><strong>Library Games:</strong> {$library_games}</p>";
	echo '<ul class="library-g
