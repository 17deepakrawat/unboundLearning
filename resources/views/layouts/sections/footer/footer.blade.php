@php
  $containerFooter = isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact' ? 'container-xxl' : 'container-fluid';
@endphp

<div class="modal fade" id="modal-md" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content" id="modal-md-content">
    </div>
  </div>
</div>

<div class="modal fade" id="modal-lg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" id="modal-lg-content">
    </div>
  </div>
</div>

<div class="modal fade" id="modal-xl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" id="modal-xl-content">
    </div>
  </div>
</div>

<div class="modal fade" id="modal-md-top" data-bs-backdrop="static" style="z-index:9999" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content" id="modal-md-top-content">
    </div>
  </div>
</div>

<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div class="{{ $containerFooter }}">
    <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
      <div>
        ©
        <script>
          document.write(new Date().getFullYear())
        </script>, Made with ❤️ by <a href="{{ !empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '' }}" target="_blank" class="footer-link text-primary fw-medium">{{ !empty(config('variables.creatorName')) ? config('variables.creatorName') : '' }}</a>
      </div>
      <div class="d-none d-lg-inline-block">
        <a href="{{ config('variables.support') ? config('variables.support') : '#' }}" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
      </div>
    </div>
  </div>
</footer>
<!--/ Footer-->
