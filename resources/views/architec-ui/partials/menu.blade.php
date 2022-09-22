<li class="app-sidebar__heading">Menú</li>



@can('zona_management_access')
<li >
    <a href="{{route('zona.index')}}">
        <i class="metismenu-icon pe-7s-rocket"></i>
        <span>Zonas</span>
    </a>
</li>
@endcan

@can('promotor_management_access')
<li >
    <a href="{{route('promotor.index')}}">
        <i class="metismenu-icon pe-7s-users"></i>
        <span>Promotor</span>
    </a>
</li>
@endcan

@can('evento_management_access')
<li >
    <a href="{{route('evento.index')}}">
        <i class="metismenu-icon pe-7s-speaker"></i>
        <span>Eventos</span>
    </a>
</li>
@endcan


@can('socios_management_access')
<li >
    <a href="{{route('socio.index')}}">
        <i class="metismenu-icon pe-7s-users"></i>
        <span>Socios</span>
    </a>
</li>
@endcan

@can('clientes_management_access')
<li >
    <a href="{{route('cliente.index')}}">
        <i class="metismenu-icon pe-7s-users"></i>
        <span>Cliente</span>
    </a>
</li>
@endcan


@can('reporte_management_access')

    <li >
        <a href="#">
            <i class="metismenu-icon pe-7s-graph2"></i>
            Reportes
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>

        <ul>

            <li>
                <a href="{{route('reporte.general')}}">
                    <span>Reporte General</span>
                </a>
            </li>
            <li >
                <a href="{{route('reporte.evento-zona')}}">
                    <span>Reporte Evento-Zona</span>
                </a>
            </li>
            <li >
                <a href="{{route('reporte.clientes-por-promotor')}}">
                    <span>Reporte por Promotor</span>
                </a>
            </li>

        </ul>
    </li>
@endcan



{{--
@can('vigilante_management_access')
<li >
    <a href="{{route('administrator.index')}}">
        <i class="metismenu-icon pe-7s-users"></i>
        <span>Vigilantes</span>
    </a>
</li>
@endcan
--}}


    <li >
        <a href="{{route('administrator.index')}}">
            <i class="metismenu-icon pe-7s-lock"></i>
            <span>Usuarios</span>
        </a>
    </li>


