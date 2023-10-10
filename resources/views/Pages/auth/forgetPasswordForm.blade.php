<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PM Planner</title>

   <!-- Custom fonts for this template-->
   <link href="{{ asset('js/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   <link
       href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
       rel="stylesheet"><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">





   <!-- Custom styles for this template-->
   <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="position: relative;">
                                <img src="{{ asset('img/jalin-logo.png') }}" alt="" srcset="" style="height: 40%; position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
                            </div>
                            <div class="col-lg-6 ">
                                <div class="p-5 bg-gray-200">
                                    <div class="text-center">
                                        <h1 class="h4 text-primary mb-4">Reset Password</h1>
                                    </div>
                                    <form class="user" id="resetPasswordForm" novalidate >
                                        @csrf
                                       
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Input New Password" name="password" required>
                                            <input type="hidden" value="" name="hash" id="hash">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="rePassword" placeholder="Re Input New Password" name="reinputPass" required>
                                        </div>
                                      
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Reset Password">
                                            
                                       
                                       
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/">Back to Login</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        @include('Components.Auth.forgotPasswordModal')
    </div>

     <!-- Bootstrap core JavaScript-->
     <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
     <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 
     <!-- Core plugin JavaScript-->
     <script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>
 
     <!-- Custom scripts for all pages-->
     <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
     <script src="{{ asset('js/BootstrapFormValidation.js') }}"></script>


     <script>
       
       $(document).ready(function () {
        const hash = window.location.pathname.split('/')[3]
        document.querySelector("#hash").value = hash
        
       });
      
        

        $("#resetPasswordForm").submit(function (e) { 
            const pass = $("#password").val()
            const repass = $("#rePassword").val();
            e.preventDefault();
            if (pass !== repass) {
                Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Password Tidak Match" ,
                    })

                return 
            }

            $.ajax({
                type: "post",
                url: "{{route('reset.password')}}",
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Password Berhasil diganti" ,
                    })
                }
            });
            
        });

            
        
      
     </script>
</body>

</html>