<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{url('/home')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
    
    @if(Auth::user()->action != 3)
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="{{url('/clinic_details')}}">
              <i class="bi bi-circle"></i><span>All Clinic Details</span>
            </a>
          </li>
          <li>
            <a href="{{url('/clinic')}}">
              <i class="bi bi-circle"></i><span>Add Clinic Location</span>
            </a>
          </li>
        </ul>
      </li>
     
    @endif
    
    @if(Auth::user()->action == 2)
    
    <li class="nav-item">
        <a class="nav-link " href="{{url('/store-eq')}}">
          <i class="bi bi-basket"></i>
          <span>Store Equipment</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/category')}}">
          <i class="bi bi-basket"></i>
          <span>Add Category</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/manufacturer')}}">
          <i class="bi bi-basket"></i>
          <span>Add Manufacturer</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/product')}}">
          <i class="bi bi-basket"></i>
          <span>Add Product</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/unit')}}">
          <i class="bi bi-basket"></i>
          <span>Add Unit</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/dispatch')}}">
          <i class="bi bi-basket"></i>
          <span>Dispatch</span>
        </a>
      </li>
  @endif
  </ul>

</aside><!-- End Sidebar-->