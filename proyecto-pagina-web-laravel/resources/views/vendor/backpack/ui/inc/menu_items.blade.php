{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Teléfonos útiles" icon="la la-tv" :link="backpack_url('phone')" />
<x-backpack::menu-item title="Info Cooperativa" icon="la la-tv" :link="backpack_url('infocoop')" />
<x-backpack::menu-item title="Info Municipal" icon="la la-tv" :link="backpack_url('infoMuni')" />
<x-backpack::menu-item title="Info Remises" icon="la la-tv" :link="backpack_url('infoTaxi')" />

<x-backpack::menu-item title="Farmacias" icon="la la-heartbeat" :link="backpack_url('pharmacy')" />
<x-backpack::menu-item title="Excepcion Farmacias" icon="la la-heartbeat" :link="backpack_url('exception-pharmacy')" />
<x-backpack::menu-item title="Servicios Sociales" icon="la la-heartbeat" :link="backpack_url('social-service')" />