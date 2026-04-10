<!doctype html>
<html lang="zxx">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap Min CSS -->
   <link rel="stylesheet" href={{"assets/css/bootstrap.min.css"}}>
   <!-- Animate Min CSS -->
   <link rel="stylesheet" href={{"assets/css/animate.min.css"}}>
   <!-- Owl Carousel Min CSS -->
   <link rel="stylesheet" href={{"assets/css/owl.carousel.min.css"}}>
   <!-- Fontawesome CSS -->
   <link rel="stylesheet" href={{"assets/css/fontawesome.min.css"}}>
   <!-- Odometer CSS -->
   <link rel="stylesheet" href={{"assets/css/odometer.css"}}>
   <!-- Popup CSS -->
   <link rel="stylesheet" href={{"assets/css/magnific-popup.min.css"}}>
   <!-- Slick CSS -->
   <link rel="stylesheet" href={{"assets/css/slick.min.css"}}>
   <!-- Style CSS -->
   <link rel="stylesheet" href={{"assets/css/style.css"}}>
   <!-- Responsive CSS -->
   <link rel="stylesheet" href={{"assets/css/responsive.css"}}>


   <!-- <link rel="stylesheet" href="assets/css/copyright.css"> -->


   <title>Gestion des sessions de formation des fondateurs</title>

   {{-- <link rel="icon" type="image/png" href="assets/img/cpntic.png"> --}}

   <!-- Pour le footer ou copyright -->

</head>

<body data-spy="scroll" data-offset="120" style="background-color: #333;">

   <!-- Start Preloader Area -->
   {{-- <div class="preloader">
      <div class="preloader">
         <span></span>
         <span></span>
      </div>
   </div> --}}
   <!-- End Preloader Area -->

   <!-- Header Start -->
   <div class="container-fluid bg-breadcrumb">
      <div class="container text-center">
         <h5 style="color: #fff; text-align: center;">RENFORCEMENT DES CAPACITES DES FONDATEURS DES ETABLISSEMENTS PRIVES DU METFPA</h5>
         <p style="color: #fff; text-align: center;">--------------------</p>
         <h5 style="color: #fff; text-align: center;">THEME : LE COFFRE A OUTILS DU MANAGER</h5>
      </div>
   </div>
   {{-- <div class="container-fluid bg-breadcrumb" style="position: fixed; top: 0; width: 100%; z-index: 1000;">
   <div class="container text-center">
      <h5 style="color: #fff; text-align: center;">RENFORCEMENT DES CAPACITES DES FONDATEURS DES ETABLISSEMENTS PRIVES DU METFPA</h5>
      <p style="color: #fff; text-align: center;">--------------------</p>
      <h5 style="color: #fff; text-align: center;">THEME : LE COFFRE A OUTILS DU MANAGER</h5>
   </div>
</div> --}}

   <!-- Header End -->


   <!-- Start About Area -->
   <section class="about-area ptb-100">
      <div class="container">
         <div class="section-title">
         </div><br>
         <div class="row">
            <div class="col-xl-9 mx-auto">
               
               <h4 class="text-white fw-bold" style="text-align: center;">FORMULAIRE D'INSCRIPTION</h4>
               <!-- <h1 class="mb-0 text-uppercase">Formulaire d'inscription </h1> -->
               @if(Session::has('message'))
               <div class="alert alert-success">
                  {{Session::get('message')}}
               </div>
               @endif
               @if(Session::has('messages'))
               <div class="alert alert-danger">
                  {{Session::get('messages')}}
               </div>
               @endif
               <div class="card-body">
                  <div class="p-4 border rounded" style="background-color: #fff;">
                     <form id="inscription" class="row g-3 needs-validation" method="post" action="/inscription" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">

                           <label for="validationCustom01" class="form-label text-center d-block">Nom</label>
                           <input type="text" class="form-control" id="validationCustom01" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="col-md-6">
                           <label for="validationCustom02" class="form-label text-center d-block">Prenom</label>
                           <input type="text" class="form-control" id="validationCustom02" name="prenom" placeholder="Prenom" required>
                        </div>

                        <div class="col-md-6">
                           <label for="validationCustomUsername" class="form-label text-center d-block">Adresse mail</label>
                           <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span>
                              <input type="email" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="validationCustomUsername" class="form-label text-center d-block">Fonction</label>
                           <div class="input-group has-validation">
                              <select class="form-control required" name="fonctionpersonnels_id" required>
                                 @foreach($fonctions as $fonction)
                                    <option value="{{$fonction->id}}"> {{$fonction->libellefonction}}
                                    </option>
                                    @endforeach
                              </select>                           
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="validationCustomUsername" class="form-label text-center d-block">Numéro de téléphone</label>
                           <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">#</span>
                              <input type="text" class="form-control" id="validationCustomUsername" name="contact" aria-describedby="inputGroupPrepend" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="validationCustomUsername" class="form-label text-center d-block">Numéro en cas d'indisponibilité</label>
                           <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">#</span>
                              <input type="text" class="form-control" id="validationCustomUsername" name="contact_2" aria-describedby="inputGroupPrepend" required>
                           </div>
                        </div><br>

                        <div class="col-12">
                           <label for="etablissements" class="form-label text-center d-block">Choisissez vos établissements</label>
                           <select class="form-select w-100" name="etablissements_id[]" id="etablissements" multiple multiselect-search="true" required size="5">
                              @foreach($etablissements as $etablissement)
                              <option value="{{ $etablissement->id }}">{{ $etablissement->denominationetab }}</option>
                              @endforeach
                           </select>
                        </div>

                        <div class="col-md-12">
                           <label for="validationCustom03" class="form-label text-center d-block">Choisissez votre session</label>
                           <select class="form-control required" name="sessionformations_id" required>
                              @foreach($sessions as $session)
                              @if($session->participants < $session->capacite)
                                 <option value="{{$session->id}}"> <strong>{{$session->libelle}}</strong> DU {{ date('d/m/Y', strtotime($session->date_debut)) }} AU
                                    {{ date('d/m/Y', strtotime($session->date_fin)) }}
                                 </option>
                                 @else
                                 <option value="{{$session->id}}" style="color:red" disabled> {{$session->libelle}} DU {{ date('d/m/Y', strtotime($session->date_debut)) }} AU
                                    {{ date('d/m/Y', strtotime($session->date_fin)) }}
                                 </option>
                                 @endif
                                 @endforeach
                           </select>
                        </div>

                        <br><br>

                        <div class="col-12" style="text-align: center">
                           <br>
                           <button class="btn btn-primary" type="submit">Validez l'inscription</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>


   </section>
   <!-- End About Area -->

   <!-- Start Copy Right Area -->
   <!-- End Copy Right Area -->

   <!-- Copyright Start -->
   <div class="container copyright text-center col-md-12 mt-4" style="background-color: #fff; color: #333; ">
      <p>© <span>Copyright</span> <strong class="sitename">DEP-METFPA collect</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
         <!-- All the links in the footer should remain intact. -->
         <!-- You can delete the links only if you've purchased the pro version. -->
         <!-- Licensing information: https://bootstrapmade.com/license/ -->
         <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
         Designed by <a href="https://cpntic.com/">Cpntic</a>
      </div>
   </div>
   <!-- Copyright End -->

   <!-- Start Go Top Section -->
   <div class="go-top">
      <i class="fa fa-chevron-up"></i>
      <i class="fa fa-chevron-up"></i>
   </div>
   <!-- End Go Top Section -->
    <!-- POUR LE multiselect -->
   <script type="text/javascript" src={{"assets/frontend1/js/multiselect-dropdown.js"}}></script>
   <!-- jQuery Min JS -->
   <script src={{"assets/js/jquery-3.5.1.min.js"}}></script>
   <!-- Popper Min JS -->
   <script src={{"assets/js/popper.min.js"}}></script>
   <!-- Bootstrap Min JS -->
   <script src={{"assets/js/bootstrap.min.js"}}></script>
   <!-- Owl Carousel Min JS -->
   <script src={{"assets/js/owl.carousel.min.js"}}></script>
   <!-- Appear JS -->
   <script src={{"assets/js/jquery.appear.js"}}></script>
   <!-- Odometer JS -->
   <script src={{"assets/js/odometer.min.js"}}></script>
   <!-- Slick JS -->
   <script src={{"assets/js/slick.min.js"}}></script>
   <!-- Particles JS -->
   <script src={{"assets/js/particles.min.js"}}></script>
   <!-- Ripples JS -->
   <script src={{"assets/js/jquery.ripples-min.js"}}></script>
   <!-- Popup JS -->
   <script src={{"assets/js/jquery.magnific-popup.min.js"}}></script>
   <!-- WOW Min JS -->
   <script src={{"assets/js/wow.min.js"}}></script>
   <!-- AjaxChimp Min JS -->
   <script src={{"assets/js/jquery.ajaxchimp.min.js"}}></script>
   <!-- Form Validator Min JS -->
   <script src={{"assets/js/form-validator.min.js"}}></script>
   <!-- Contact Form Min JS -->
   <script src={{"assets/js/contact-form-script.js"}}></script>
   <!-- Main JS -->
   <script src={{"assets/js/main.js"}}></script>

</body>

</html>