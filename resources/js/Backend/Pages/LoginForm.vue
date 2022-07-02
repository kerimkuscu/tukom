<template>
  <div class="container h-100">
    <div class="row align-items-center h-100">
      <div class="col-6 mx-auto">
        <ImagePreview src="/tukom-logo.png" alt="TUKOM Electronics" image-style="height: 50%" />

        <div class="card mt-5">
          <div class="card-body">
            <form autocomplete="off" method="post" @submit.prevent="login">
              <div v-if="errors.has('error')" class="alert alert-danger">
                {{ errors.first('error') }}
              </div>

              <div class="row mb-3">
                <label for="email" class="col-md-3 col-form-label">{{ $t('messages.login.email') }}</label>

                <div class="col-md-9">
                  <input
                    id="email"
                    v-model="email"
                    type="email"
                    class="form-control"
                    required
                    autocomplete="email"
                    autofocus
                  >
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-3 col-form-label">{{ $t('messages.login.password') }}</label>

                <div class="col-md-9">
                  <input
                    id="password"
                    v-model="password"
                    type="password"
                    class="form-control"
                    required
                    autocomplete="current-password"
                  >
                </div>
              </div>

              <div class="row mb-0">
                <div class="offset-md-3">
                  <Button type="submit" :label="$t('messages.login.login')" class="p-button-rounded w-50" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Errors } from 'form-backend-validation';

    export default {

        name: 'LoginForm',

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

                        const redirectTo = redirect ? redirect.from.fullPath : '/products-list/';

                        this.$router.push(redirectTo)
                        window.location.reload();
                    },

                    error: (error) => {
                        if (error.response && error.response.data.errors) {
                            this.errors.record(error.response.data.errors);
                            return;
                        }

                        this.errors.record({ error: ['Something went wrong'] });
                    },

                    rememberMe: true,
                    fetchUser: true
                })
            },
        }
    }
</script>
