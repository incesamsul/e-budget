<!---Thanks to undraw-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-budget !</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </head>
  <body>
      <div class="container">
          <div class="img">
              <img src="{{ asset('img/logo.png') }}" width="100"/>
            </div>
            <div class="login-container">
                <form action="{{ URL::to('/postlogin') }}" method="POST">
                    @csrf
                    {{-- <img class="avator" src="{{ asset('stisla/assets/img/logo-min.jpg') }}" /> --}}
                    <h2>E-BUDGET STIKES GRAHA EDUKASI</h2>
                    @if (session('fail'))
                    <p style="color: red;" class="text-danger">{{ session('fail') }}</p>
                    @endif
          <div class="input-div" one>
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div>
              {{-- <h5>Username</h5> --}}
              <input class="input" type="text" name="email" placeholder="Username"/>
            </div>
          </div>
          <div class="input-div" two>
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div>
              {{-- <h5>password</h5> --}}
              <input class="input" type="password" name="password" placeholder="Password"/>
            </div>
          </div>
          <input type="submit" class="btn" value="Login" />
          <table style="width: 100%">
            <tr>
              <td>
                {{-- <a href="{{ URL::to('/bantuan') }}"><i class="fas fa-question-circle"></i> <span>Bantuan</span></a> --}}
              </td>
              <td>
                {{-- <a href="{{ URL::to('/passwords') }}">Forgot password ?</a> --}}
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
