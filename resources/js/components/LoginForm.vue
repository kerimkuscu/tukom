<template>
    <div>
        <form autocomplete="off" method="post" @submit.prevent="login">
            <div v-if="errors.has('error')" class="alert alert-danger">
                {{ errors.first('error') }}
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" autofocus>

                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password">


                </div>
            </div>


            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                </div>
            </div>

        </form>
    </div>
</template>

<script>
import {Errors} from 'form-backend-validation';

    export default {
        created() {
            // axios.get('/sanctum/csrf-cookie').then(response => {
            //     this.getUser();
            // });
        },

        // data(){
        //     return {
        //         user: null,
        //         login : {
        //             email: '',
        //             password: ''
        //         }
        //     }
        // },

        data: () => ({
            errors: new Errors,

            email: null,
            password: null,
            // remember_me: 1,
        }),

        methods: {
            // async submit(){
            //     await axios.post('/login', this.login)
            //
            //     await this.getUser();
            //
            //     window.location.href = '/products/'
            // },

            login() {
                const app = this;

                this.errors.clear();

                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password,
                        // remember_me: app.remember_me
                    },

                    success: () => {
                        let redirect = this.$auth.redirect();

                        const redirectTo = redirect ? redirect.from.fullPath : '/products/';

                        this.$router.push(redirectTo)
                    },

                    error: (error) => {
                        if (error.response && error.response.data.errors) {
                            this.errors.record(error.response.data.errors);
                            return;
                        }

                        this.errors.record({error: ['Something went wrong']});
                    },

                    rememberMe: true,
                    fetchUser: true
                })
            },

            // async getUser(){
            //     const response = axios.get('/api/user');
            //
            //     this.user = response.data
            //
            //     // axios.post('api/menus',{
            //     //     'name': 'test2',
            //     //     'parent_id': '5'
            //     // }).then(response => {
            //     //     console.log(response.data);
            //     // });
            // }
        }
    }
</script>
