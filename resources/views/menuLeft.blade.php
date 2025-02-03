<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{route('home')}}" class="">
        <span class="app-brand-text demo menu-text fw-bolder"><img src="{{asset('assets/img/unibol-sas.png')}}" class="img-fluid"/></span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    @php 
     // $modulo = explode('.', Route::currentRouteName());
      
    @endphp
    <ul class="menu-inner py-1 pt-5"> 
      @forelse(active_user()->getMenuLeft() as $menu)

        <li class="menu-item {{$menu->menuTop()}}  @if($menu->menuTop() == $menu->id) open active @endif ">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <!-- <i class="menu-icon tf-icons bx {{$menu->iconapp ?? 'bx-menu' }}"></i> !-->
            <div data-i18n="{{$menu->nameapp}}">{{$menu->nameapp}}</div>
          </a>
          <ul class="menu-sub">
            
              @foreach ($menu->submenu->get() as $submenu)
                
                @if ( $submenu->submenu->count() )
                  
                    
                   <li class="menu-item mb-2 mx-2  @if($submenu->is_parent() ==  $submenu->id || $submenu->id == cmodule()->id  ) open active @endif ">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <!-- <i class="menu-icon tf-icons bx {{$menu->iconapp ?? 'bx-menu' }}"></i> !-->
                      <div data-i18n="{{$submenu->nameapp}}">{{$submenu->nameapp}}</div>
                    </a>

                      <ul class="menu-sub">

                          @if ($submenu->urlapp)
                            <li class="menu-item mb-2 mx-2 @if($submenu->activeRoute()) active @endif" > 
                              <a href="{{route($submenu->urlapp)}}"> @if ($submenu->nameapp_alias) {{$submenu->nameapp_alias}} @else {{$submenu->nameapp}} @endif</a>
                            </li>
                          @endif

                          @foreach ($submenu->submenu->get() as $submenu2) 
                          <li class="menu-item  mb-2 mx-2 @if($submenu2->activeRoute()) active @endif">
                              <a href="{{route($submenu2->urlapp)}}">@if ($submenu2->nameapp_alias) {{$submenu2->nameapp_alias}} @else {{$submenu2->nameapp}} @endif</a>
                          </li>
                          @endforeach
                      </ul>
                  </li>
                @else    

                  <li class="menu-item  mb-2 mx-2 @if($submenu->activeRoute()) active @endif" > 
                    <a href="@if ($submenu->urlapp) {{route($submenu->urlapp)}} @else # @endif" class="menu-link">
                      <i class="menu-icon tf-icons bx {{$submenu->iconapp ?? 'bx-menu' }} {{$menu->activeRoute()}}"></i>
                      <div data-i18n="Layouts">@if ($submenu->nameapp_alias) {{$submenu->nameapp_alias}} @else {{$submenu->nameapp}} @endif</div>
                    </a>
                  </li>
                @endif
              @endforeach 
          </ul>
        </li>
 
      @empty
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link ">
          <div data-i18n="Layouts">Sin Opciones</div>
        </a>
      </li>
      @endforelse
    </ul>
 
    
  
  </aside>
  <!-- / Menu -->