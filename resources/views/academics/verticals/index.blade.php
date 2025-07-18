@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Verticals')

@section('content')
  <h4 class="mb-4">Verticals</h4>

  <!-- Vertical Cards -->
  <div class="row g-4">
    @foreach ($verticals as $vertical)
      <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <img class="ratio ratio-16x9 mb-3" height="125px" src="{{ !empty($vertical->logo) ? asset($vertical->logo) : '' }}" alt="{{ $vertical->name }}">
            <span class="badge rounded-pill bg-{{ $vertical->is_active ? 'success' : 'danger' }} badge-dot badge-notifications"></span>
            <div class="d-flex justify-content-between">
              <div>
                <h4 class="card-title m-0">{{ $vertical->name }}</h4>
                <p class="text-muted p-0 m-0">{{ $vertical->vertical_name }}</p>
              </div>
              <div>
                @can('edit verticals')
                  <span type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-edit"></i></span>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" onclick="edit('{{ route('academics.verticals.edit', [$vertical->id]) }}', 'modal-lg')" href="javascript:void(0);">Edit</a></li>
                    <li><a class="dropdown-item" href="{{ route('website.content.vertical.testimonial', [$vertical->id]) }}">Testimonials</a></li>
                    @if ($vertical->for_website == 1)
                      <li><a class="dropdown-item" href="{{ route('academics.verticals.content', $vertical->id) }}">Content</a></li>
                    @endif
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('academics.verticals.configurations', $vertical->id) }}">Configuration</a></li>
                    <li><a class="dropdown-item" href="{{ route('academics.verticals.form-designer', $vertical->id) }}">Application Form Designer</a></li>
                  </ul>
                @endcan
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card h-100">
        <div class="row h-100">
          <div class="col-sm-5">
            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
              <img src="{{ asset('assets/img/illustrations/add-new-roles.png') }}" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <a href="javascript:void(0)" onclick="add('{{ route('academics.verticals.create') }}', 'modal-lg')" class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Vertical</a>
              <p class="mb-0 mt-1">Add vertical, if it does not exist</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Vertical Cards -->

@endsection
