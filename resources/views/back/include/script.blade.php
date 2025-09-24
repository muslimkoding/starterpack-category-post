<script src="{{ asset('src-back/js/core.bundle.min.js') }}"></script>
{{-- <script src="{{ asset('src-back/js/core-simplebar.js') }}"></script> --}}
<script>
  const header = document.querySelector('header.header');

  document.addEventListener('scroll', () => {
    if (header) {
      header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
    }
  });
</script>
<script src="{{ asset('src-back/js/core-index.js') }}"></script>
<script src="{{ asset('src-back/js/core-main.js') }}"></script>
<script></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
  integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
  data-cf-beacon='{"rayId":"95ce535d7a34f91c","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.6.2","token":"496f8c1a159448ef82d6c94971e63824"}'
  crossorigin="anonymous"></script>

  
@stack('js')
