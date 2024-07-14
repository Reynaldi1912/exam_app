<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

<li class="nav-heading">Home</li>


  @if(Auth::user()->role == 'admin')
    <li class="nav-item">
      <a class="nav-link collapsed" href="#">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('question.index')}}">
        <i class="bi bi-card-heading"></i>
        <span>Exam Question</span>
      </a>
    </li><!-- End Dashboard Nav -->
  @endif

  @if(Auth::user()->role == 'user')
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('exam.room')}}">
        <i class="bi bi-grid"></i>
        <span>Exam Room</span>
      </a>
    </li><!-- End Dashboard Nav -->
  @endif

  @if(Auth::user()->role == 'admin')

  <li class="nav-heading">Setting</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('exam.index')}}">
      <i class="bi bi-person"></i>
      <span>Exam</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{route('user.index')}}">
      <i class="bi bi-people"></i>
      <span>User</span>
    </a>
  </li><!-- End Profile Page Nav -->
</ul>

@endif

</aside><!-- End Sidebar-->