<template>
    <div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" v-model="login.email" required autocomplete="email" autofocus>

            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" v-model="login.password" required autocomplete="current-password">


            </div>
        </div>


        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" @click="submit">
                    Login
                </button>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                this.getUser();
            });
        },

        data(){
            return {
                user: null,
                login : {
                    email: '',
                    password: ''
                }
            }
        },

        methods: {
            submit(){
                axios.post('/login', this.login).then(response => {
                    this.getUser();
                });
            },

            getUser(){
                axios.get('/api/user').then(response => {
                    this.user = response.data
                });

                axios.post('api/menus',{
                    'name': 'test2',
                    'parent_id': '5'
                }).then(response => {
                    console.log(response.data);
                });
            }
        }
    }
</script>
