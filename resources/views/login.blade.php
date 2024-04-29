@extends('components.layout')

@section('title', 'Connexion')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="@if($userExist) {{ route('login') }} @else {{ route('create') }} @endif">
                        @csrf
                        <div class="divider d-flex align-items-center my-4"></div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="email">Adresse email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" />
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" />
                        </div>

                        @if (!$userExist)
                            <div data-mdb-input-init class="form-outline mb-3">
                                <label class="form-label" for="confirm-password">Confimer le mot de passe</label>
                                <input type="password" name="confirm-password" id="confirm-password" class="form-control form-control-lg" />
                            </div>
                        @endif

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">@if($userExist) Connexion @else Créer @endif</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Victorien Rodrigues &copy; {{ now()->year }}
            </div>
            <!-- Copyright -->
        </div>
    </section>
@endsection


<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    .h-custom {
        height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>
