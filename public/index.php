<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Ma Librairie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#accueil">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="produit.php">Produit</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="accueil">
    <div class="p-3 mb-2 bg-primary text-white">
        <h1 class="text-center">Bienvenue sur notre site</h1>
        <p class="text-center">Des services modernes, rapides et efficaces.</p>
        <p class="text-center"><button type="button" class="btn btn-light">Voir nos services</button></p>
    </div>
</section>

<section id="services" class="container my-5">
    <h2 class="text-center mb-4">Nos services</h2>
    <div class="row">
        <?php
        $services = [
            ["Service 1", "Description brève du service 1."],
            ["Service 2", "Description brève du service 2."],
            ["Service 3", "Description brève du service 3."]
        ];
        foreach ($services as $s) {
            echo '<div class="col-md-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">'.$s[0].'</h5>
                            <p class="card-text">'.$s[1].'</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                  </div>';
        }
        ?>
    </div>
</section>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">A propos de nous</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
</section>

</body>
</html>