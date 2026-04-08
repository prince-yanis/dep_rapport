<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Append Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?php echo e(asset ('assets/img/favicon.png'), false); ?>" rel="icon">
  <link href="<?php echo e(asset ('assets/img/apple-touch-icon.png'), false); ?>" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo e(asset ('assets/vendor/bootstrap/css/bootstrap.min.css'), false); ?>" rel="stylesheet">
  <link href="<?php echo e(asset ('assets/vendor/bootstrap-icons/bootstrap-icons.css'), false); ?>" rel="stylesheet">
  <link href="<?php echo e(asset ('assets/vendor/aos/aos.css'), false); ?>" rel="stylesheet">
  <link href="<?php echo e(asset ('assets/vendor/glightbox/css/glightbox.min.css'), false); ?>" rel="stylesheet">
  <link href="<?php echo e(asset ('assets/vendor/swiper/swiper-bundle.min.css'), false); ?>" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?php echo e(asset ('assets/css/main.css'), false); ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Append
  * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="<?php echo e(asset ('assets/img/logo.png'), false); ?>" alt=""> -->
        <h1 class="sitename">DEEP</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Accueil</a></li>
          <li><a href="#about">A propos de nous</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Galerie</a></li>
          <!-- <li><a href="index.html#pricing">Pricing</a></li> -->
          <!-- <li><a href="index.html#team">Team</a></li> -->
          <!-- <li><a href="blog.html">Blog</a></li> -->
          <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> -->
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="<?php echo e(env('APP_URL'), false); ?>admin"  target="_blank">Administration</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="https://img.freepik.com/photos-gratuite/technicien-qui-passe-travers-plateformes-serveurs_482257-90838.jpg?ga=GA1.1.1270830439.1704980351&semt=ais_hybrid" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Bienvenue sur l'espace de control de la DEP</h2>
            <p data-aos="fade-up" data-aos-delay="200">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, velit!</p>
          </div>
          <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
            <form action="#" method="post" class="php-email-form">
              <div class="sign-up-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <!-- <section id="clients" class="clients section">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="<?php echo e(asset ('assets/img/clients/client-1.png'), false); ?>" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="<?php echo e(asset ('assets/img/clients/client-2.png'), false); ?>" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="<?php echo e(asset ('assets/img/clients/client-3.png'), false); ?>" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="<?php echo e(asset ('assets/img/clients/client-4.png'), false); ?>" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="<?php echo e(asset ('assets/img/clients/client-5.png'), false); ?>" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="<?php echo e(asset ('assets/img/clients/client-6.png'), false); ?>" class="img-fluid" alt="">
          </div>

        </div>

      </div>

    </section> -->
    <!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h3>Qui sommes-nous</h3>
            <h2>Qui sommes-nous</h2>
            <p>La mission de la DEEP est avant tout d’encadrer les promoteurs à fournir des établissements privés, respectant les normes pour garantir un environnement sain et inspirant nos enfants dans leur quête de l’excellence.</p>
            <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-buildings"></i>
                  <h3>demande de subvention des établissements primaires 2022</h3>
                  <p>Vous pouvez procéder à la formulation en ligne des demandes de subventions pour les établissements primaires.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-clipboard-pulse"></i>
                  <h3>Demande d'agrément & Changement administratif 2022</h3>
                  <p>Vous pouvez procéder à l'enregistrement en ligne de vos demandes d'agrément et de vos demandes de changement administratif.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-command"></i>
                  <h3>Autorisation du personnel session 2022</h3>
                  <p>Vous pouvez procéder à l'enregistrement en ligne de vos demandes d'autorisation d'enseigner, de diriger et d'exercer la fonction d'éducateur.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-graph-up-arrow"></i>
                  <h3>Recueil des capacités et du montant total des frais</h3>
                  <p>Vous pouvez saisir les capacités d'accueil de vos établissements et aussi le montant total des frais appliqués aux élèves affectés.</p>
                </div>
              </div> <!-- End Icon Box -->

            </div>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section dark-background">

      <img src="<?php echo e(asset ('assets/img/stats-bg.jpg'), false); ?>" data-aos="fade-in">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="93000" data-purecounter-duration="1" class="purecounter"></span>
              <p>ELEVES</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="613" data-purecounter-duration="1" class="purecounter"></span>
              <p>ETS PRIVES</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
              <p>DD</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
              <p>DR</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
              <div>
                <h4 class="title"><a href="services-details.html" class="stretched-link">Recueil des capacités</a></h4>
                <p class="description">Vous pouvez saisir les capacités d'accueil de vos établissements et aussi le montant total des frais appliqués aux élèves affectés.</p>
              </div>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
              <div>
                <h4 class="title"><a href="services-details.html" class="stretched-link">Edition des décisions de paiements</a></h4>
                <p class="description">Edition des décisions de paiement des établissements privés</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
              <div>
                <h4 class="title"><a href="services-details.html" class="stretched-link">Transferts et reports de scolarité</a></h4>
                <p class="description">Vous pouvez procéder à l'enregistrement en ligne de vos demandes de transfert (Privé-privé) et de réport de scolarité.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
              <div>
                <h4 class="title"><a href="services-details.html" class="stretched-link">Autorisation d'exercer du personnel dans les établissements privés techniques.</a></h4>
                <p class="description"> Il est porté à la connaissance des candidats dont les dossiers ont été validés que dans le cadre de l’octroi d’autorisations d’exercer (enseigner, diriger, la fonction de SERFE ou d’éducateur) </p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="500">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-brightness-high"></i></div>
              <div>
                <h4 class="title"><a href="services-details.html" class="stretched-link">Demande agréments et Changement administratif. (CNCSEP 2023)</a></h4>
                <p class="description">COMMISSION NATIONALE DE LA CARTE SCOLAIRE DES ETABLISSEMENTS PRIVES (CNCSEP) session 2023</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="600">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-calendar4-week"></i></div>
              <div>
                <h4 class="title"><a href="services-details.html" class="stretched-link">Mise à jour des contacts établissements</a></h4>
                <p class="description">Vous pouvez mettre à jour les contacts téléphoniques et électroniques de vos établissements privés.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h3>Corporis temporibus maiores provident</h3>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
            </p>
            <a href="<?php echo e(env('APP_URL'), false); ?>/amdin" target="_blank" class="btn btn-get-started">Administration</a>
          </div>
          <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <div class="image-stack">
              <img src="<?php echo e(asset ('assets/img/features-light-1.jpg'), false); ?>" alt="" class="stack-front">
              <img src="<?php echo e(asset ('assets/img/features-light-2.jpg'), false); ?>" alt="" class="stack-back">
            </div>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-stretch justify-content-between features-item ">
          <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
            <img src="<?php echo e(asset ('assets/img/features-light-3.jpg'), false); ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
            <h3>Sunt consequatur ad ut est nulla</h3>
            <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe odit aut quia voluptatem hic voluptas dolor doloremque.</p>
            <ul>
              <li><i class="bi bi-check"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
              <li><i class="bi bi-check"></i><span> Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
              <li><i class="bi bi-check"></i> <span>Facilis ut et voluptatem aperiam. Autem soluta ad fugiat</span>.</li>
            </ul>
            <a href="#" class="btn btn-get-started align-self-start">Get Started</a>
          </div>
        </div><!-- Features Item -->

      </div>

    </section><!-- /Features Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Galerie</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Actualité</li>
            <li data-filter=".filter-product">Reunion</li>
            <li data-filter=".filter-branding">Formation</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="https://lh3.googleusercontent.com/proxy/nR8Zg_oKnjuvNkrZ_FQ-DMvzCI_reMnBE-Bd5EruxO8Tsf_vWSKq3amc_Aflu9PU2PZYlNsX1BAmDbDBsgRyFVH3SWQRyI7T6VyJbEFxTJeNbV7YdW8gAdgJxGZfPgs" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 1</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://lh3.googleusercontent.com/proxy/nR8Zg_oKnjuvNkrZ_FQ-DMvzCI_reMnBE-Bd5EruxO8Tsf_vWSKq3amc_Aflu9PU2PZYlNsX1BAmDbDBsgRyFVH3SWQRyI7T6VyJbEFxTJeNbV7YdW8gAdgJxGZfPgs" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="https://lh3.googleusercontent.com/proxy/FPYQv8J9lYdhIigYfCcnNxb2KZpKzHxIWBw1kRj2nOyPECEA18GDHUAf0gl3rOZ7W36HRJ9JzTS6wKD6ZDP5OkoY6NXH0vkw7L-vUQqbhlNSfjW6GY40XuiZDvhLNSgyTPbJ" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Product 1</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://lh3.googleusercontent.com/proxy/FPYQv8J9lYdhIigYfCcnNxb2KZpKzHxIWBw1kRj2nOyPECEA18GDHUAf0gl3rOZ7W36HRJ9JzTS6wKD6ZDP5OkoY6NXH0vkw7L-vUQqbhlNSfjW6GY40XuiZDvhLNSgyTPbJ" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="https://jdeditionsmagazine.tv/storage/2023/11/JD-Editions-Mag-et-TV-METFPA-Reunion-de-la-rentree-2023-2024-DEEP-Etablissements-Prives-Bilan-et-Perspectives-1600x1101.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Branding 1</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://jdeditionsmagazine.tv/storage/2023/11/JD-Editions-Mag-et-TV-METFPA-Reunion-de-la-rentree-2023-2024-DEEP-Etablissements-Prives-Bilan-et-Perspectives-1600x1101.jpg" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406095510_285001261199197_2352924397107907724_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=vmScDxkgKUsQ7kNvgEgA5N0&_nc_ht=scontent.fabj3-2.fna&oh=00_AYAXX7pJdSkxhw4T8_ON6VPa4nLkT5iohHy_xVRYuoYL2g&oe=66DB6FFE" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 2</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406095510_285001261199197_2352924397107907724_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=vmScDxkgKUsQ7kNvgEgA5N0&_nc_ht=scontent.fabj3-2.fna&oh=00_AYAXX7pJdSkxhw4T8_ON6VPa4nLkT5iohHy_xVRYuoYL2g&oe=66DB6FFE" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406095510_285001261199197_2352924397107907724_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=vmScDxkgKUsQ7kNvgEgA5N0&_nc_ht=scontent.fabj3-2.fna&oh=00_AYAXX7pJdSkxhw4T8_ON6VPa4nLkT5iohHy_xVRYuoYL2g&oe=66DB6FFE" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Product 2</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406095510_285001261199197_2352924397107907724_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=vmScDxkgKUsQ7kNvgEgA5N0&_nc_ht=scontent.fabj3-2.fna&oh=00_AYAXX7pJdSkxhw4T8_ON6VPa4nLkT5iohHy_xVRYuoYL2g&oe=66DB6FFE" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406563207_285002641199059_4068818089713957304_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=127cfc&_nc_ohc=aCvKNQgqsIQQ7kNvgEI8UJG&_nc_ht=scontent.fabj3-2.fna&oh=00_AYCg-oUtnaymZUBVAJJsJOtbfBWxBdWwEilDhYNcmOSFgg&oe=66DB7AA1" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Branding 2</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406563207_285002641199059_4068818089713957304_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=127cfc&_nc_ohc=aCvKNQgqsIQQ7kNvgEI8UJG&_nc_ht=scontent.fabj3-2.fna&oh=00_AYCg-oUtnaymZUBVAJJsJOtbfBWxBdWwEilDhYNcmOSFgg&oe=66DB7AA1" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406545158_285003524532304_9195049307998138186_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=9DxbjNnwy6IQ7kNvgF_wq5J&_nc_ht=scontent.fabj3-2.fna&oh=00_AYDEH44kgAdc7-8oRREAKmxD4AYyv_o3D6_YTGiWKNwJGg&oe=66DB8552" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 3</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406545158_285003524532304_9195049307998138186_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_ohc=9DxbjNnwy6IQ7kNvgF_wq5J&_nc_ht=scontent.fabj3-2.fna&oh=00_AYDEH44kgAdc7-8oRREAKmxD4AYyv_o3D6_YTGiWKNwJGg&oe=66DB8552" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406570483_285003791198944_4508165821286067603_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=127cfc&_nc_ohc=tYrG036ObWgQ7kNvgGXj3wG&_nc_ht=scontent.fabj3-2.fna&oh=00_AYB095lM4SuK556aPFmQviZmNEehG6jWxx4oiCRBcEzRsA&oe=66DB69AD" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Product 3</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/406570483_285003791198944_4508165821286067603_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=127cfc&_nc_ohc=tYrG036ObWgQ7kNvgGXj3wG&_nc_ht=scontent.fabj3-2.fna&oh=00_AYB095lM4SuK556aPFmQviZmNEehG6jWxx4oiCRBcEzRsA&oe=66DB69AD" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/457245679_452530671112921_9035693337061292740_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=127cfc&_nc_ohc=EoVx1gwr7a0Q7kNvgGtBA6z&_nc_ht=scontent.fabj3-2.fna&oh=00_AYA9CGCGdfPJccUEbsK46XOgMA4WkilDnhkKL8estdXm-g&oe=66DB7327" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Branding 3</h4>
                <p>Lorem ipsum, dolor sit</p>
                <a href="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/457245679_452530671112921_9035693337061292740_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=127cfc&_nc_ohc=EoVx1gwr7a0Q7kNvgGtBA6z&_nc_ht=scontent.fabj3-2.fna&oh=00_AYA9CGCGdfPJccUEbsK46XOgMA4WkilDnhkKL8estdXm-g&oe=66DB7327" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Pricing Section -->
    <!-- <section id="pricing" class="pricing section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div>

      <div class="container" data-aos="zoom-in" data-aos-delay="100">

        <div class="row g-4">

          <div class="col-lg-4">
            <div class="pricing-item">
              <h3>Free Plan</h3>
              <div class="icon">
                <i class="bi bi-box"></i>
              </div>
              <h4><sup>$</sup>0<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="pricing-item featured">
              <h3>Business Plan</h3>
              <div class="icon">
                <i class="bi bi-rocket"></i>
              </div>

              <h4><sup>$</sup>29<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="pricing-item">
              <h3>Developer Plan</h3>
              <div class="icon">
                <i class="bi bi-send"></i>
              </div>
              <h4><sup>$</sup>49<span> / month</span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              </ul>
              <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
            </div>
          </div>

        </div>

      </div>

    </section> -->
    <!-- /Pricing Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
              <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
              </p>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">
              <div class="faq-item faq-active">
                <h3><span class="num">1.</span> <span>Non consectetur a erat nam at lectus urna duis?</span></h3>
                <div class="faq-content">
                  <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">2.</span> <span>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</span></h3>
                <div class="faq-content">
                  <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">3.</span> <span>Dolor sit amet consectetur adipiscing elit pellentesque?</span></h3>
                <div class="faq-content">
                  <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">4.</span> <span>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</span></h3>
                <div class="faq-content">
                  <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">5.</span> <span>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</span></h3>
                <div class="faq-content">
                  <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>
        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="<?php echo e(asset ('assets/img/cta-bg.jpg'), false); ?>" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Call To Action</h3>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <a class="cta-btn" href="#">Call To Action</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    <!-- Recent Posts Section -->
    
    <!-- /Recent Posts Section -->

    <!-- Contact Section -->
    <!-- <section id="contact" class="contact section">

      
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>A108 Adam Street</p>
                  <p>New York, NY 535022</p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday</p>
                  <p>9:00AM - 05:00PM</p>
                </div>
              </div>

            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </section> -->
    <!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">DEEP-METFPA</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <!-- <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div> -->

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>ABIDJAN, COCODY Lycée Technique, Abidjan, Côte d'Ivoire</p>
          <p>Abidjan, Cocody</p>
          <p>Côte d'ivoire</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+225 0704268117</span></p>
          <p><strong>Email:</strong> <span>deep_assistance@formation.gouv.ci</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="sitename">DEEP-METFPA collect</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://cpntic.com/">Cpntic</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?php echo e(asset ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/php-email-form/validate.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/aos/aos.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/glightbox/js/glightbox.min.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/purecounter/purecounter_vanilla.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/isotope-layout/isotope.pkgd.min.js'), false); ?>"></script>
  <script src="<?php echo e(asset ('assets/vendor/swiper/swiper-bundle.min.js'), false); ?>"></script>

  <!-- Main JS File -->
  <script src="<?php echo e(asset ('assets/js/main.js'), false); ?>"></script>

</body>

</html><?php /**PATH C:\wamp64\www\dep_rapport\resources\views/index.blade.php ENDPATH**/ ?>