<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIJAGA - Silahkan Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('public/login') }}/assets/images/logo/baru.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ url('public/login') }}/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex"
            style="background-image: url('{{ url('public/login') }}/assets/images/others/login11.jpg')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="{{ url('public') }}/logokppn.png"
                                            width="100" height="20">
                                        <h2 class="m-b-0 mt-2" style="margin-right: 120px;">Login</h2>
                                    </div>
                                    <hr>

                                    <form action="{{ url('login') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <x-template.utils.notif />
                                            </div>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        <div class="form-group" data-validate="Diperlukan User ID yang valid">
                                            <label class="font-weight-semibold" for="userName">MASUKAN EMAIL :</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="form-group" data-validate="Diperlukan Password">
                                            <label class="font-weight-semibold" for="password">MASUKAN PASSWORD
                                                :</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password">
                                                <i class="suffix-icon anticon anticon-eye toggle-password"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                </span>
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-sign-in-alt"></i> | LOGIN
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="" style="color: white">© 2024 Sistem Informasi Jadwal dan Agenda</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-white text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-white text-link" href="">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan ini di bagian bawah body atau di tempat yang sesuai -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <!-- Core Vendors JS -->
    <script src="{{ url('public/login') }}/assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{ url('public/login') }}/assets/js/app.min.js"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(icon) {
            icon.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                this.classList.toggle('anticon-eye');
                this.classList.toggle('anticon-eye-invisible');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        });
    </script>


</body>

</html>
