<link href="{{asset('libs/sbadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
<link rel="icon" href="{{asset('img/DrPetLogo.png')}}" type="image">
<script>
    document.title = "Correo no verificado | Dr. Pet"
</script>
<div class="bg-gradient-light">
    @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
    @endif
    <div class="row align-items-center h-100">
        <div class="card text-center border-secondary mb-3 col-6 mx-auto" style="width: 50rem;">
            <div class="card-header">
                <img src="{{ asset('img/DrPetLogo.png') }}" width="200" height="auto">
            </div>
            <div class="card-body">
                <h5 class="card-title">No se ha verificado su correo</h5>
                <p class="card-text">Gracias por crear una cuenta, antes de continuar, parece que tu correo electrónico no está verificado. Click aquí para reenviar a tu correo la verificación.</p>
            </div>

            <div class="card-footer align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <button type="submit" class="btn btn-primary">
                        Reenviar verificación
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-light">
                        Log Out
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>