<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecléctica</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}">

  <!-- STYLES CSS -->

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- FONT AWESOME ICONS -->
  <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

  <!-- MATERIAL ICONS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


  <!-- BOOTSTRAP JAVASCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

</head>

<body>
  <x-flashMessage />
  <!-- Conteúdo da Página -->
  <section class="p-3 p-md-4 p-xl-5 ">
    <div class="container d-flex justify-content-center">
      <div class="row">
        <div class="col-12 col-xxl-11 border-light-subtle">
          <div class="row g-0 bg-light shadow rounded">
            <div class="col-12 col-md-6 d-none d-md-block">
              <img class="img-fluid rounded-start h-100 object-fit-cover" loading="lazy" src="{{ asset('assets/images/login_background.jpg') }}" alt="Ecléctica Log In Page!">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
              <div class="col-12 col-lg-11 col-xl-10">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <div class="text-center mb-4">
                          <img src="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}" alt="Ecléctica Logo" height="57">
                        </div>
                        <h4 class="text-center fw-bold mb-0">Ecléctica Leilões</h4>
                        <p class="text-center mt-0">Aplicação de Gestão</p>
                      </div>
                    </div>
                  </div>

                  <form method="POST" action="/login">
                    @csrf
                    @method('POST')
                    <div class="row gy-3 overflow-hidden">
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="user" id="user" placeholder="" required>
                          <label for="email" class="form-label">User</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                          <label for="password" class="form-label">Password</label>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn btn-dark btn-lg" type="submit">Log in</button>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>