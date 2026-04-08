<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Append Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset ('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset ('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset ('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset ('assets/css/main.css') }}" rel="stylesheet">

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
        <!-- <img src="{{ asset ('assets/img/logo.png') }}" alt=""> -->
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

      <a class="btn-getstarted" href="{{ env('APP_URL') }}admin"  target="_blank">Administration</a>

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
            <img src="{{ asset ('assets/img/clients/client-1.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset ('assets/img/clients/client-2.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset ('assets/img/clients/client-3.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset ('assets/img/clients/client-4.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset ('assets/img/clients/client-5.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset ('assets/img/clients/client-6.png') }}" class="img-fluid" alt="">
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

      <img src="{{ asset ('assets/img/stats-bg.jpg')}}" data-aos="fade-in">

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
            <a href="{{ env('APP_URL') }}/amdin" target="_blank" class="btn btn-get-started">Administration</a>
          </div>
          <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <div class="image-stack">
              <img src="{{ asset ('assets/img/features-light-1.jpg')}}" alt="" class="stack-front">
              <img src="{{ asset ('assets/img/features-light-2.jpg')}}" alt="" class="stack-back">
            </div>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-stretch justify-content-between features-item ">
          <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
            <img src="{{ asset ('assets/img/features-light-3.jpg')}}" class="img-fluid" alt="">
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

      <img src="{{ asset ('assets/img/cta-bg.jpg')}}" alt="">

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
    {{-- <section id="recent-posts" class="recent-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Recent Posts</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <article>

              <div class="post-img">
                <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/457037161_452530377779617_1591541564744248872_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=127cfc&_nc_ohc=nZRdRuRF20kQ7kNvgGRkORS&_nc_ht=scontent.fabj3-2.fna&oh=00_AYAwV-I-G49Lj10vJnMVrpD7_6rGtDNgE2XRC8dhEs6nfQ&oe=66DB6898" alt="" class="img-fluid">
              </div>

              <p class="post-category">Formation</p>

              <h2 class="title">
                <a href="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FDEEPMETFPA%2Fposts%2Fpfbid02DrfgkQsb9mNcw75qJgLG71ZL3gNSz5iRKmHLwvrRFUGiKXesXT7LJ8J7Y9fgsx5fl&show_text=true&width=500" >Atelier de Formation du Personnel d’Encadrement des Etablissements Privés</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="data:image/png;base64,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" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">DEEP-METFPA</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">oct 26, 2024</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <article>

              <div class="post-img">
                <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/454244447_439553969077258_7524870658340064796_n.jpg?stp=dst-jpg_s600x600&_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_ohc=ni7BKP3v1gcQ7kNvgE3mKSz&_nc_ht=scontent.fabj3-2.fna&oh=00_AYC3WlZ_zp46TzUV8S1hrcOFuZywL4McPA0-q_JoK1Hl8g&oe=66DB6972" alt="" class="img-fluid">
              </div>

              <p class="post-category">Reunion</p>

              <h2 class="title">
                <a href="https://www.facebook.com/DEEPMETFPA/posts/pfbid0u5BsKqH1aRCvWK53AZtDT4soMtd8jVmqQiw9kV1MWSb4hKW8v7DWscwJJRfVRTzEl">Réunion bilan de l'année scolaire 2023-2024 tenue entre la Direction de l'Encadrement des Etablissements Privés (DEEP) et les présidents des faîtières le mardi 06 aout 2024 à la salle de la Direction Générale de la Formation Initiale (DGFI)</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="data:image/png;base64,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" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">DEEP-METFPA</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">aout 7, 2024</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <article>

              <div class="post-img">
                <img src="https://scontent.fabj3-2.fna.fbcdn.net/v/t39.30808-6/419488176_348979241468065_2944524596008171206_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_ohc=SUc8D58fs4wQ7kNvgHc_q8p&_nc_ht=scontent.fabj3-2.fna&oh=00_AYAD9hBG91NtKhB5NBj0_672R2sugLZWORnu4Bp_edylSw&oe=66DB629A" alt="" class="img-fluid">
              </div>

              <p class="post-category">Entertainment</p>

              <h2 class="title">
                <a href="https://www.facebook.com/DEEPMETFPA/posts/pfbid0AwwTDkM46AT4AbwuAoh9zYL1SxLdd5343kbzd71Q3rsSpSeG38Y86sY7gp5NKBhVl">La Directrice de l'Encadrement des Etablissements Privés a eu des rencontres d'échanges avec les Directions Régionales</a>
              </h2>

              <div class="d-flex align-items-center">
                <img src="data:image/png;base64,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" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">DEEP-METFPA</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">mars 15, 2024</time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

        </div><!-- End recent posts list -->

      </div>

    </section> --}}
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
  <script src="{{ asset ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset ('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset ('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset ('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset ('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset ('assets/js/main.js') }}"></script>

</body>

</html>