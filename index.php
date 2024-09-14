<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-cuts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    
</head>


<body>
    <!-- Header section / navigation -->
    <div class="hero">
      <div class="navbar">
        <div class="logo">
          <a href="index.php">T-Cuts</a>
        </div>
        <div class="n-c">
          <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">My Tickets</a></li>
            <li><a href="#">Loyalty</a></li>
            <li><a href="#">Support</a></li>
            <li><button type="submit" style="text-decoration: none; color: aliceblue;"><a href="register.php" >Sign Up</a></button></li>
          </ul>
          <!-- <div class="nav-icon">
            <i class="fas fa-bars"></i>
          </div> -->
        </div>
      </div>
      <div class="hero-text">
        <h1>Unlock Unforgettable Moments</h1>
        <p>Welcome to T-Cuts, where extraordinary experiences await. Elevate your moments and create memories that last a lifetime. Whether it's a concert that moves your soul, a sports event that ignites your passion, or a theatrical performance that captivates your imagination, we've got the tickets to turn your dreams into reality.</p>
       
        <button class="buy-ticket-btn"> <a href="login.php" style="text-decoration: none; color: aliceblue;">Buy Tickets Now</a> </button>
        <div style="text-align:center; margin-top: 40px;">
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
      </div>
    </div>

<!-- now showing -->
<div class="now-showing">
    <h2>Now Showing</h2>
    <div class="movie-grid">
      <div class="movie">
        <div class="movie-info">
          <h3>Movie 1</h3>
          <p>Rating: PG-13</p>
          <p>Showtimes:</p>
          <ul>
            <li>1:00pm</li>
            <li>4:00pm</li>
            <li>7:00pm</li>
          </ul>
          <button> <a href="login.php" style="text-decoration: none; color: aliceblue;"> Buy Tickets</a></button>
        </div>
        <img src="https://cdn.europosters.eu/image/350/posters/the-batman-downpour-i123456.jpg" alt="Movie 1">
      </div>
      <div class="movie">
        <div class="movie-info">
          <h3>Movie 2</h3>
          <p>Rating: R</p>
          <p>Showtimes:</p>
          <ul>
            <li>2:00pm</li>
            <li>5:00pm</li>
            <li>8:00pm</li>
          </ul>
          <button> <a href="login.php" style="text-decoration: none; color: aliceblue;"> Buy Tickets</a></button>
        </div>
        <img src="https://mir-s3-cdn-cf.behance.net/projects/404/2ed8a3143422723.Y3JvcCw0NjY5LDM2NTIsMjc3LDExMzI.png" alt="Movie 2">
      </div>
      <!-- repeat movie div for movies 3-6 -->
      <div class="movie">
        <div class="movie-info">
          <h3>Movie 3</h3>
          <p>Rating: PG</p>
          <p>Showtimes:</p>
          <ul>
            <li>12:00pm</li>
            <li>3:00pm</li>
            <li>6:00pm</li>
            <li>9:00pm</li>
          </ul>
          <button> <a href="login.php" style="text-decoration: none; color: aliceblue;"> Buy Tickets</a></button>
        </div>
        <img src="https://flxt.tmsimg.com/assets/p14652182_b_v8_aa.jpg" alt="Movie 3">
      </div>
      <div class="movie">
        <div class="movie-info">
          <h3>Movie 4</h3>
          <p>Rating: PG</p>
          <p>Showtimes:</p>
          <ul>
            <li>11:00am</li>
            <li>2:00pm</li>
            <li>5:00pm</li>
            <li>8:00pm</li>
          </ul>
          <button> <a href="login.php" style="text-decoration: none; color: aliceblue;"> Buy Tickets</a></button>
        </div>
        <img src="https://allears.net/wp-content/uploads/2021/03/Loki-Poster.jpg" alt="Movie 4">
      </div>
      <div class="movie">
        <div class="movie-info">
          <h3>Movie 5</h3>
          <p>Rating: PG-13</p>
          <p>Showtimes:</p>
          <ul>
            <li>12:30pm</li>
            <li>3:30pm</li>
            <li>6:30pm</li>
            <li>9:30pm</li>
          </ul>
          <button> <a href="login.php" style="text-decoration: none; color: aliceblue;"> Buy Tickets</a></button>
        </div>
        <img src="https://cdn.marvel.com/content/1x/marvsmposterbk_intdesign.jpg" alt="Movie 5">
      </div>
      <div class="movie">
        <div class="movie-info">
          <h3>Movie 5</h3>
          <p>Rating: PG-13</p>
          <p>Showtimes:</p>
          <ul>
            <li>12:30pm</li>
            <li>3:30pm</li>
            <li>6:30pm</li>
            <li>9:30pm</li>
          </ul>
          <button> <a href="login.php" style="text-decoration: none; color: aliceblue;"> Buy Tickets</a></button>
        </div>
        <img src="https://cdn.marvel.com/content/1x/online_11.jpg" alt="Movie 5">
      </div>
    </div>
</div>

<!-- sponsers -->
<section class="sponsor-partners">
  <h2>Our Sponsor Partners</h2>
  <div class="sponsor-grid">
    <div class="sponsor">
      <img src="https://cdn.esewa.com.np/ui/images/esewa_og.png?111" alt="Sponsor 1">
    </div>
    <div class="sponsor">
      <img src="https://dao578ztqooau.cloudfront.net/static/img/logo1.png" alt="Sponsor 2">
    </div>
    <div class="sponsor">
      <img src="https://play-lh.googleusercontent.com/-Dh97DQp7zHwg8X03-vqTz-IuziW7ce3sz5_TBOMEcDFAnToXKlkEQ3lprVHy2Qq44ms" alt="Sponsor 3">
    </div>
    <div class="sponsor">
      <img src="https://www.newbusinessage.com/img/news/20180531010749_IME-Pay-Logo_white%20(2).jpg" alt="Sponsor 4">
    </div>
  </div>
</section>

<!-- now showing -->
<div class="now-showing">
  <h2>Comming Soon</h2>
  <div class="movie-grid">
    <div class="movie">
      <div class="movie-info">
        <h3>Movie 1</h3>
        <p>Rating: PG-13</p>
        <p>Showtimes:</p>
        <ul>
          <li>1:00pm</li>
          <li>4:00pm</li>
          <li>7:00pm</li>
        </ul>
        <button>Buy Tickets</button>
      </div>
      <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce91f0174694883.64a6b352166cc.jpg" alt="Movie 1">
    </div>
    <div class="movie">
      <div class="movie-info">
        <h3>Movie 2</h3>
        <p>Rating: R</p>
        <p>Showtimes:</p>
        <ul>
          <li>2:00pm</li>
          <li>5:00pm</li>
          <li>8:00pm</li>
        </ul>
        <button>  Buy Tickets</button>
      </div>
      <img src="https://media.senscritique.com/media/000020861363/300/dunki.jpg" alt="Movie 2">
    </div>
    <!-- repeat movie div for movies 3-6 -->
    <div class="movie">
      <div class="movie-info">
        <h3>Movie 3</h3>
        <p>Rating: PG</p>
        <p>Showtimes:</p>
        <ul>
          <li>12:00pm</li>
          <li>3:00pm</li>
          <li>6:00pm</li>
          <li>9:00pm</li>
        </ul>
        <button>Buy Tickets</button>
      </div>
      <img src="https://m.media-amazon.com/images/M/MV5BMGI0ZDg3Y2EtYzIyYi00MGYwLThlOGItNWQ5MjMxNDU2ODUzXkEyXkFqcGdeQXVyMTEwMTcxOTAx._V1_.jpg" alt="Movie 3">
    </div>
  </div>
</div>

<!-- footer -->
<footer class="footer">
  <div class="footer-content">
    <div class="footer-column">
      <h4>About Us</h4>
      <p>We are a movie ticket management system that makes it easy for you to buy tickets, choose seats, and track your reservations.</p>
    </div>
    <div class="footer-column">
      <h4>Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Movies</a></li>
        <li><a href="#">Theaters</a></li>
        <li><a href="#">Reservations</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Follow Us</h4>
      <ul class="social-icons">
        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2023 Movie Ticket Management System. All rights reserved.</p>
  </div>
</footer>

<!-- JavaScript for toggling menu -->
<script src="script.js"></script>

</body>
</html>