<script>document.title="Login | Dr. Pet"</script>        
<link rel="icon" href="{{asset('img/DrPetLogo.png')}}" type="image">

<x-guest-layout>

        <x-jet-validation-errors class="mb-4" />

<div class="container">
 <!-- Outer Row --> 
 <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="{{ asset('img/DrPetLogo.png') }}" style="width: 5rem; height: auto;">
                                <hr>
                                <h1>¡Bienvenido!</h1>
                                <hr>
                            </div>
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="email" aria-describedby="emailHelp"
                                            placeholder="Correo electrónico..."
                                            name="email" :value="old('email')" >
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="password" placeholder="Contraseña..." required autocomplete="current-password" >
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                            <label class="custom-control-label" for="remember_me" >Recordarme</label>
                                        </div>
                                    </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Inicar sesión</button>
                                        <hr>
                                        @if (Route::has('password.request'))
                                            <div class="text-center">    
                                                <a class="small" href="{{ route('password.request') }}">
                                                    {{ __('¿Olvidaste tu contraseña?') }}
                                                </a>
                                            </div>
                                        @endif
                                </form>
                                <hr>
                        </div>
                    </div>
                    </div>
                </div>
                        
            </div>
        </div>
    </div>
</div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>



</x-guest-layout>
