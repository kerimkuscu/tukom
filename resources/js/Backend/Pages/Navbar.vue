<template>
  <nav v-if="show" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container m-0">
      <a class="navbar-brand" href="#">
        <ImagePreview src="/tukom-logo.png" alt="TUKOM Electronics" image-style="height: 50px" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarSupportedContent" class="collapse navbar-collapse mt-3">
        <ul v-if="$auth.check()" class="navbar-nav me-auto">
          <li class="nav-item">
            <router-link :to="{name:'users.grid'}" class="nav-link">
              Users
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'menus.grid'}" class="nav-link">
              Menus
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'products.grid'}" class="nav-link">
              Products
            </router-link>
          </li>

          <li class="nav-item">
            <router-link :to="{name:'brands.grid'}" class="nav-link">
              Brands
            </router-link>
          </li>
        </ul>

        <ul v-else class="navbar-nav me-auto">
          <li class="nav-item">
            <Menu />
          </li>

          <li class="nav-item">
            <router-link :to="{name:'communication'}" class="nav-link">
              Communication
            </router-link>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
          <li v-if="$auth.check()" class="nav-item dropdown">
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
              <button class="dropdown-item" @click="$auth.logout(); $router.push('/login');">
                Logout
              </button>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>

import Menu from '../../Frontend/Menu';

export default {
    name: 'Navbar',

    components: {
        Menu
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
            queryString === '/login' ? this.show = false : true;
        }
    }
}
</script>
