<?php
  // Start the session
  require_once('session.php');

  // Insert the page header
  $page_title = 'Fight to the finish!';
  require_once('header.php');
  
  require_once('connectvars.php');
  
  // Show the navigation menu
  require_once('navmenu.php');
  
  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  // Retrieve the user data from MySQL
  $query = "SELECT user_id, username, first_name, last_name FROM battle_clash_user";
  $data = mysqli_query($dbc, $query);
  
  if (isset($_GET['idtodelete']))  //This means we clicked on the delete link
    {
        $idtodelete = $_GET['idtodelete'];
        $deletequery = "DELETE from battle_clash_user where user_id=$idtodelete";
        mysqli_query($dbc,$deletequery);
    }
  
  // Loop through the array of user data, formatting it as HTML
  echo '<h4>Latest members:</h4>';
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) {
    if (isset($_SESSION['user_id'])) {
      echo '<tr><td class="userinfo">';
      echo '<strong>Username:</strong> ' . $row['username'] .'<br />';
      echo '<strong>Name:</strong> '. $row['first_name'] . ' ' . $row['last_name'] 
      ."<a href = \"".$_SERVER['PHP_SELF']."?idtodelete="
      .$row['user_id']."\"> Delete</a>".'</td></tr>';
    }
    else {
      echo '<tr><td class="userinfo">';
      echo '<strong>Username:</strong> ' . $row['username'] 
        ."<a href = \"".$_SERVER['PHP_SELF']."?idtodelete="
        .$row['user_id']."\"> Delete</a>".'</td></tr>';
    }
  }
  echo '</table>';

  mysqli_close($dbc);
?>

<?php
  // Insert the page footer
  require_once('footer.php');
?>