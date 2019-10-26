<aside class="main-sidebar">
  <section class="sidebar">
  


    <ul class="sidebar-menu" data-widget="tree">
  
      <li class="header">MENU</li>

      <li :class="menu == 0 ?'active':''" @click="menu=0">
          <a href="#">
              <i class="fa fa-file-text-o"></i> <span>ENTREVISTA</span>
          </a>
      </li>

      <li  :class="menu == 1 ?'active':''" @click="menu=1">
          <a href="#">
              <i class="fa fa-book"></i> <span>TEST</span>
          </a>
      </li>

      </li>

    </ul>
  </section>
</aside>