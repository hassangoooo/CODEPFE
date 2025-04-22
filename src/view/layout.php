<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/codestage/src/css/style.css">
    <script type="module" src="/codestage/src/js/script.js"></script>
    <title>Document</title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="logo">
        <a href="index.php?route=home"> Rest<span>to</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
       </div>
    <div class="container-fluid">
   
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  les cuisines 
                </a>
                <ul class="dropdown-menu">
                  <li id="cuisinemarocaine"><a class="dropdown-item" href="#">marocainne</a></li>
                  <li id="cuisineukrainienne"><a class="dropdown-item" href="#">ukrainniene</a></li>
               
                </ul>
              </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              les plats
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">
                <label for="entrée">entrée</label>
                <input type="checkbox" name="entrée" id="entrée">
                </a> 
            </li>
            <li><a class="dropdown-item" href="#">
                <label for="entrée">plats</label>
                <input type="checkbox" name="entrée" id="entrée">
                </a> 
            </li>
            <li><a class="dropdown-item" href="#">
                <label for="entrée">desserts</label>
                <input type="checkbox" name="entrée" id="entrée">
                </a>
            </li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Saisissez votre ville" aria-label="Search">
          <button class="btn btn-outline-danger" type="submit">Search</button>
        </form>
       <div  class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          connexion</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="index.php?route=client">CLIENT</a></li>
          <li><a class="dropdown-item" href="index.php?route=cuisinieres">CUISINIERES</a></li>
        </ul>
       </div>
        
        
      
        <div class="cart-icon" id="Panier">🛒<span id="cart-count">0</span></div>

      </div>
    </div>
  </nav>
    
</header>
<div id="cart-container">
  <span class="close-cart" id="close">✖ Fermer</span>
  <h2>Panier</h2>
  <ul id="cart"></ul>
  <p><strong>Total: <span id="total">0</span>€</strong></p>
</div>
<div class="overlay"></div>
<main id="notre-main">
  <?= $content ?>
</main>
</body>
</html>