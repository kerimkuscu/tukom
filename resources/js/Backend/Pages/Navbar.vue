<template>
  <nav v-if="show" class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffffff !important">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <ImagePreview src="/tukom-logo.png" alt="TUKOM Electronics" image-style="height: 55px" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon" />
      </button>
      <div id="navbarSupportedContent" class="collapse navbar-collapse mt-3">
        <ul v-if="$auth.check()" class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link :to="{name:'menus.grid'}" class="nav-link">
              {{ $t('navbar.headers.menus') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'products-list.grid'}" class="nav-link">
              {{ $t('navbar.headers.products') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'brands.grid'}" class="nav-link">
              {{ $t('navbar.headers.brands') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'quotes.grid'}" class="nav-link">
              {{ $t('navbar.headers.quotes') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'contacts.grid'}" class="nav-link">
              {{ $t('navbar.headers.contacts') }}
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'users.grid'}" class="nav-link">
              {{ $t('navbar.headers.users') }}
            </router-link>
          </li>
        </ul>

        <ul v-else class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <SidebarMenu />
          </li>

          <router-link :to="{name:'index'}" class="nav-link" style="margin-left: 3em">
            {{ $t('navbar.headers.home') }}
          </router-link>
        </ul>

        <router-link v-if="!$auth.check()" :to="{name:'contact'}" class="nav-link" style="color: rgb(115 115 115)">
          {{ $t('navbar.headers.contact') }}
        </router-link>

        <router-link v-if="!$auth.check()" :to="{name:'about'}" class="nav-link" style="color: rgb(115 115 115)">
          {{ $t('navbar.headers.about_us') }}
        </router-link>

        <router-link v-if="!$auth.check()" :to="{name:'quote'}" class="nav-link" style="color: rgb(115 115 115)">
          {{ $t('navbar.headers.quote_request') }}
        </router-link>

        <ul v-if="$auth.check()" class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a
              v-pre
              id="navbarDropdown"
              class="float-end nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="pi pi-user" />
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <button class="dropdown-item" @click="authLogout">
                {{ $t('navbar.headers.logout') }}
              </button>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>

import SidebarMenu from '../../Frontend/SidebarMenu';

export default {
    name: 'Navbar',

    components: {
        SidebarMenu,
    },

    data: () => ({
        show: true,
    }),

    mounted() {
        this.showNavbar();
    },

    methods: {
        showNavbar() {
            let queryString = window.location.pathname;
            queryString === '/login' ? this.show = false : this.show = true;
        },

        authLogout() {
            this.$auth.logout();
            this.$router.push('/login');
            window.location.reload();
        }
    }
}
</script>
