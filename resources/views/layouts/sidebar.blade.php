<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
  <div class="logo">
    <div class="brand">
      <img src="{{asset('assets/img/icon.png')}}" alt="logo">
    </div>
    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      CV.Lintas Nusa
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="{{'home' == request()->path() ? 'active' : ''}}">
        <a class="nav-link" href="{{ url('/home') }}">
          <i class="material-icons">dashboard</i>
          <p>Home</p>
        </a>
      </li>
      @guest
      @else
      @if(Auth()->user()->role == "admin")
      <li class="{{'lowongan' == request()->segment(1) ? 'active' : ''}}">
        <a class="nav-link" href="{{route('lowongan.index')}}">
          <i class="material-icons">insert_chart</i>
          <p>Lowongan</p>
        </a>
      </li>
      <li class="{{'pelamar' == request()->segment(1) ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('pelamar.index') }}">
          <i class="fas fa-users"></i>
          <p>Pelamar</p>
        </a>
      </li>
      <li class="{{'daftar_soal' == request()->segment(1) ? 'active' : ''}}">
        <a class="nav-link" href="{{route('daftar_soal.index')}}">
          <i class="fas fa-book"></i>
          <p>Daftar Soal</p>
        </a>
      </li>
      <li class="{{'jadwal_tes' == request()->segment(1) ? 'active' : ''}}">
        <a class="nav-link" href="{{route('jadwal_tes.index')}}">
          <i class="far fa-clock"></i>
          <p>Jadwal Tes</p>
        </a>
      </li>
      @endif
      @if(Auth()->user()->role == "customer")

      @endif
      @endguest


    </ul>
  </div>