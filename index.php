<?php

if (isset($_GET['username'])) {
  // Replace <YOUR_API_KEY> with your actual Fortnite Tracker API key
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
    $display_name = $data[0]->epicUserHandle;
    $avatar_url = $data[0]->avatar;
    $favorite_games = array('Fortnite', 'Rocket League', 'Among Us');
    $library_games = array(
      array('cover' => 'fortnite.jpg', 'title' => 'Fortnite', 'hours' => $data[0]->lifeTimeStats[7]->value),
      array('cover' => 'rocket-league.jpg', 'title' => 'Rocket League', 'hours' => 50),
      array('cover' => 'among-us.jpg', 'title' => 'Among Us', 'hours' => 25)
    );
?>
    <section class="account-info">
      <div class="account-container">
        <img src="<?php echo $avatar_url; ?>" alt="Profile Picture" class="profile-picture">
        <h2 class="account-id">Epic Games Account ID: <?php echo $account_id; ?></h2>
        <h3 class="username">Username: <?php echo $display_name; ?></h3>
        <h3 class="favorite-games">Favorite Games:</h3>
        <ul class="favorite-games-list">
          <?php foreach ($favorite_games as $game) { ?>
            <li><?php echo $game; ?></li>
          <?php } ?>
        </ul>
        <h3 class="library-games">Library Games:</h3>
        <ul class="library-games-list">
          <?php foreach ($library_games as $game) { ?>
            <li>
              <img src="<?php echo $game['cover']; ?>" alt="<?php echo $game['title']; ?>">
              <h4><?php echo $game['title']; ?></h4>
              <?php if ($game['title'] == 'Fortnite') { ?>
                <p><?php echo $game['hours']; ?> lifetime kills</p>
              <?php } else { ?>
                <p><?php echo $game['hours']; ?> hours played</p>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
      </div>
    </section>
<?php
  }
}
?>
