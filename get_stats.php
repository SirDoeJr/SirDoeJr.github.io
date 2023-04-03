<!DOCTYPE html>
<html>
<head>
	<title>Fortnite Tracker API</title>
</head>
<body>
	<form method="get">
		<label for="username">Enter a Fortnite username:</label>
		<input type="text" id="username" name="username">
		<button type="submit">Submit</button>
	</form>

	<?php
		$api_key = 'c24c53c9-ceae-4ef4-9a6a-fe38e5555301';
		$username = $_GET['username'];
		$url = "https://api.fortnitetracker.com/v1/profile/all/{$username}";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'TRN-Api-Key: c24c53c9-ceae-4ef4-9a6a-fe38e5555301'
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
			echo '<h1>Fortnite Tracker API Results</h1>';
			echo "<img src='{$picture_url}' alt='Profile picture'>";
			echo "<p>Account ID: {$account_id}</p>";
			echo "<p>Username: {$username}</p>";
			echo "<p>Favorite Games: {$favorite_games}</p>";
			echo '<ul>';
			foreach ($data[0]->stats->favorites as $favorite) {
				echo "<li>{$favorite->metadata->name} - {$favorite->value}</li>";
			}
			echo '</ul>';
			echo "<p>Library Games: {$library_games}</p>";
			echo '<ul>';
			foreach ($data[0]->stats->playtime as $game) {
				echo "<li>{$game->metadata->name} - {$game->value}</li>";
			}
			echo '</ul>';
		}
	?>
</body>
</html>

