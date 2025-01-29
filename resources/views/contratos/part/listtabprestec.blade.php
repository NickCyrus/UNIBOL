<ul class="nav nav-tabs nav-fill" role="tablist">
    <li class="nav-item">
      <button type="button" class="nav-link @if(!$acttab) active @endif" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tap1" aria-controls="navs-justified-home" aria-selected="true">
          <i class="tf-icons bx bx-dollar"></i> INGRESOS PREVISTOS</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link @if($acttab==2) active @endif" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tap2" aria-controls="navs-justified-profile" aria-selected="false">
          <i class="tf-icons bx bx-dollar"></i> COSTOS TOTALES</button>
    </li>
    <li class="nav-item">
      <button type="button" class="nav-link @if($acttab==3) active @endif" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tap3" aria-controls="navs-justified-messages" aria-selected="false">
          <i class="tf-icons bx bx-dollar"></i> COSTOS ADMINISTRATIVOS</button>
    </li>

    <li class="nav-item">
        <button type="button" class="nav-link @if($acttab==4) active @endif" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tap4" aria-controls="navs-justified-messages" aria-selected="false">
            <i class="tf-icons bx bx-dollar"></i> COSTOS DIRECTOS ESTIMADOS</button>
    </li>

    <li class="nav-item">
        <button type="button" class="nav-link @if($acttab==5) active @endif" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tap5" aria-controls="navs-justified-messages" aria-selected="false">
            <i class="tf-icons bx bx-dollar"></i> RESUMEN </button>
    </li>

    
  </ul>