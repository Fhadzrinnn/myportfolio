<?php
include_once 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>ABOUT</title>
  </head>
  <body>
    <nav>
      <div class="nav__content">
        <div class="logo"><a href="login.php">MyWork</a></div>
        <label for="check" class="checkbox">
          <i class="ri-menu-line"></i>
        </label>
        <input type="checkbox" name="check" id="check" />
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>	
          <li><a href="contacts.php">Contact</a></li>
		  <li><a href="">    </a></li>
		  <li><a href="">    </a></li>
		  <li><a href="">    </a></li>

			
        </ul>
      </div>
    </nav>
    <section class="section">
      <div class="section__container">
        <div class="content">
          <p class="subtitle">ABOUT</p>
          <h1 class="name">
            I'm <span> 
			  <?php
                        include_once 'connection.php';
                        $sql = "SELECT * FROM names";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['first_name'] . ' ' . $row['last_name'];
                        ?>
			  <br>
			  </span> Web Developer
          </h1>
          <p class="description">
           <?php
					include_once 'connection.php';

					$sql_about = "SELECT * FROM about";
					$result_about = mysqli_query($conn, $sql_about);
							if ($row_about = mysqli_fetch_assoc($result_about)) {
								$about = $row_about['about_text'];
								echo $about; 
							} else {
								  $about = "Default about if no description is found in the database.";
								   }
					?>

          </p>
          <div class="action__btns">
            <button class="hire__me">Hire Me</button>
          </div>
        </div>
        <div class="image">
           <?php
				// Retrieve the latest uploaded image
				$sql = "SELECT image_data, image_type FROM images ORDER BY id DESC LIMIT 1";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$imageData = $row['image_data'];
					$imageType = $row['image_type'];
					$base64 = base64_encode($imageData);
					$src = "data:image/" . $imageType . ";base64," . $base64;
					echo "<img src='$src' '><br>";
				} else {
					echo "<h3>No image uploaded yet.</h3>";
				}

				$conn->close();
				?>
        </div>
      </div>
    </section>
  </body>
</html>
