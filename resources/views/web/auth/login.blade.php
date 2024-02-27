@extends('template.template')

@section('content')
    <div class="card-login">
        <img class="img-logo" src="{{ asset('img/logo.jpg') }}" alt="" srcset="">

        <form class="div-form-login" id="form-login" method="POST" action="{{ route('authenticate') }}">
            @csrf
            <div class="form-group div-100">
                @error('message')
                    <div style="width: 100%; padding: 5px; background-color: #ffc8b9; border-radius: 2px; margin-bottom: 5px;">
                        <p style="font-size: 9pt; color: #d60000;">{{ $message }}</p>
                    </div>
                @enderror
                <label for="">Email</label>
                <input class="input-begin" type="email" name="email" required>
            </div>
            <div class="form-group div-100">
                <label for="">Senha</label>
                <input class="input-begin" type="password" name="password" id="" required>
                <div class="div-100 div-btn-login">
                @if(date('Y-m-d') <= '2024-06-22')
                    <a href="{{ route('register') }}" style="font-size: 10pt; margin-top: 10px;">Registar-se</a>
                @endif
                    <button class="btn-login" id="btn-login" type="submit">
                        Iniciar-sessão
                    </button>
                </div>
            </div>
        </form>

        <p class="copyright">Desenvolvido por <strong>DTIC</strong>-2023</p>
    </div>
    <div id="preloader" style="width: 100%; height: 100vh; position: absolute; top: 0; left: 0; background: #ffffff9f; display: none; justify-content: center; align-items: center;">
        <img src="{{ asset('img/load.gif') }}">
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">
        document.getElementById('form-login').addEventListener('submit', function(){
            document.getElementById('preloader').style.display = 'flex';
        });
    </script>
@endsection
