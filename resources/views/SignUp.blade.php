<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Page</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- MDB UI Kit CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet"/>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/register.css"/>

     <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
</head>
<body>

<section class="vh-100 d-flex justify-content-center align-items-center">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw1.webp"
             class="img-fluid" alt="Register image"/>
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

        <form action="{{ route('register') }}" method="POST">

            @csrf

            @if(Session::has('success'))
             <div class="alert alert-success">{{ Session::get('success') }}</div>
             @endif

             @if(Session::has('error'))
             <div class="alert alert-danger">{{ Session::get('error') }}</div>
             @endif

             @if ($errors->any())
             <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4">
            <p class="lead fw-normal mb-0 me-3">Sign up with</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-google"></i>
            </button>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>

          <!-- Name input -->
          <div class="form-outline mb-4">
            <input type="text" id="name" name="name" class="form-control form-control-lg"
                   placeholder="Enter your full name" required />
            <label class="form-label" for="name">Full Name</label>
          </div>

          <!-- Email or Mobile input -->
          <div class="form-outline mb-4">
            <input type="text" id="registerInput" name="email" class="form-control form-control-lg"
                   placeholder="Enter email or mobile number"
                   pattern="^(\+?\d{10,15}|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$"
                   title="Enter a valid email address or mobile number" required />
            <label class="form-label" for="registerInput">Email or Mobile</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="registerPassword" name="password" class="form-control form-control-lg"
                   placeholder="Enter password" required />
            <label class="form-label" for="registerPassword">Password</label>
          </div>

          <!-- Confirm Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg"
                   placeholder="Confirm password" required />
            <label class="form-label" for="confirmPassword">Confirm Password</label>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input me-2" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
              I agree to the terms and conditions
            </label>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg px-5">Register</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">
              Already have an account?
              <a href="/SignIn" class="link-danger">Login</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>


</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- MDB UI Kit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

</body>
</html>
