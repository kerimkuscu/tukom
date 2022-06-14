<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container m-0">
            <a class="navbar-brand" href="#">
                <ImagePreview src="../../../images/tukom-logo.png" alt="TUKOM Electronics" image-style="height: 50px"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">

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
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li v-if="$auth.check() === false" class="nav-item">

                    </li>

                    <li v-else class="nav-item dropdown">
                        <a id="navbarDropdown" class="float-end nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="pi pi-user"></i>
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
export default {
    name: 'Navbar',
}
</script>
