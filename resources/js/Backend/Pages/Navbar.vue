<template>
    <nav v-if="show" class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffffff !important">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <ImagePreview src="/tukom-logo.png" alt="TUKOM Electronics" image-style="height: 55px" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
                <ul v-if="$auth.check()" class="navbar-nav me-auto mb-2 mb-lg-0">
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

                <ul v-else class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <MenuList />
                    </li>
                </ul>

                <router-link v-if="!$auth.check()" :to="{name:'communication'}" class="nav-link" style="color: rgb(115 115 115)">
                    Communication
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

import MenuList from '../../Frontend/MenuList';

export default {
    name: 'Navbar',

    components: {
        MenuList
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
        }
    }
}
</script>
