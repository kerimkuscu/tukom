<template>
            <div class="row justify-content-center m-5">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form autocomplete="off" method="post" @submit.prevent="login">
                                <div v-if="errors.has('error')" class="alert alert-danger">
                                    {{ errors.first('error') }}
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-3 col-form-label">Email</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" autofocus>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-3 col-form-label">Password</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password">
                                    </div>
                                </div>


                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-5">
                                        <Button type="submit" label="Login" class="p-button-rounded"></Button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
import {Errors} from 'form-backend-validation';

    export default {

        data: () => ({
            errors: new Errors,

            email: null,
            password: null,
        }),

        methods: {

            login() {
                const app = this;

                this.errors.clear();

                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password,
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
        }
    }
</script>
