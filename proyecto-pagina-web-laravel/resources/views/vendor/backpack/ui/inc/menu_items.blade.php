{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Phones" icon="la la-question" :link="backpack_url('phone')" />
<x-backpack::menu-item title="Infocoop" icon="la la-question" :link="backpack_url('infocoop')" />
<x-backpack::menu-item title="InfoMuni" icon="la la-question" :link="backpack_url('infoMuni')" />
<x-backpack::menu-item title="InfoTaxi" icon="la la-question" :link="backpack_url('infoTaxi')" />
