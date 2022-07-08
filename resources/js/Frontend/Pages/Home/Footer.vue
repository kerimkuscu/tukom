<template>
  <div>
    <footer class="footer-10">
      <div class="container">
        <div class="row mb-5 pb-3 no-gutters">
          <div class="col-md-4 mb-md-0 mb-4 d-flex">
            <div class="con con-1 w-100 py-5">
              <div class="con-info w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                  <i class="pi pi-phone" />
                </div>
                <div class="text">
                  <span>+90 212 482 83 83</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-md-0 mb-4 d-flex">
            <div class="con con-2 w-100 py-5">
              <div class="con-info w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                  <i class="pi pi-envelope" />
                </div>
                <div class="text">
                  <span>info@tukom.com.tr</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-md-0 mb-4 d-flex">
            <div class="con con-3 w-100 py-5">
              <div class="con-info w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                  <i class="pi pi-map-marker" />
                </div>
                <div class="text">
                  <span>Mimar Sinan Mah. 1.Çakmak Sokak No 9-11 Kemerburgaz Eyupsultan / İstanbul</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2 mb-md-0 mb-4">
                <h2 class="footer-heading">
                  {{ $t('footer.useful_links') }}
                </h2>
                <ul class="list-unstyled">
                  <li>
                    <router-link :to="{name:'index'}" class="d-block">
                      {{ $t('navbar.headers.home') }}
                    </router-link>
                  </li>
                  <li>
                    <router-link v-if="!$auth.check()" :to="{name:'contact'}" class="d-block">
                      {{ $t('navbar.headers.contact') }}
                    </router-link>
                  </li>
                  <li>
                    <router-link v-if="!$auth.check()" :to="{name:'about'}" class="d-block">
                      {{ $t('navbar.headers.about_us') }}
                    </router-link>
                  </li>
                  <li>
                    <router-link v-if="!$auth.check()" :to="{name:'quote'}" class="d-block">
                      {{ $t('navbar.headers.quote_request') }}
                    </router-link>
                  </li>
                </ul>
              </div>

              <div class="col-md-4 mb-md-0 mb-4">
                <h2 class="footer-heading">
                  {{ $t('footer.about_us') }}
                </h2>
                <ul class="list-unstyled">
                  <li>
                    <span class="d-block">
                      {{ $t('footer.about_message') }}
                    </span>
                  </li>
                </ul>
              </div>

              <div class="col-md-6 mb-md-0 mb-4">
                <div class="mapouter">
                  <div class="gmap_canvas">
                    <iframe
                      id="gmap_canvas"
                      width="635"
                      height="300"
                      src="https://maps.google.com/maps?q=Mimar%20Sinan%20Mah.%201.%C3%87akmak%20Sokak%20No%20:%209-11%20Kemerburgaz%20Ey%C3%BCpsultan%20%C4%B0stanbul&t=&z=15&ie=UTF8&iwloc=&output=embed"
                      frameborder="0"
                      scrolling="no"
                      marginheight="0"
                      marginwidth="0"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5 pt-4 border-top">
          <div class="col-md-6 col-lg-8 mb-md-0 mb-4">
            <p class="copyright mb-0">
              {{ $t('footer.copyright') }} &copy;{{ date }} {{ $t('footer.reserved') }} | {{ $t('footer.brand_name') }}
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
    name: 'Footer',

    data: () => ({
        date: new Date().getFullYear()
    })
}
</script>
