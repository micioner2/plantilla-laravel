<aside class="main-sidebar">
  <section class="sidebar">
  
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
    
        <p>usuario</p>
 
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>

    <ul class="sidebar-menu" data-widget="tree">
  
      <li class="header">MENU</li>

      <li class="active" @click="menu=0">
          <a href="#">
              <i class="fa fa-home"></i> <span>Inicio</span>
          </a>
      </li>

      
      <li  @click="menu=1">
          <a href="#">
              <i class="fa fa-home"></i> <span>Preguntas</span>
          </a>
      </li>

      </li>

    </ul>
  </section>
</aside>