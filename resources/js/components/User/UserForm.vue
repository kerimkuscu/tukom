<template>
    <form @submit.prevent="submit">
        <div class="float-end">
            <Button label="Back" @click="back"/>

            <Button type="submit" label="Save" />
        </div>

        <div class="row">
            <div class="col-8 mx-auto">
                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Name</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="name"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.name"
                            placeholder="Name"
                            :class="{ 'p-invalid': form.errors.has('name')}"/>
                        <small id="name-help" class="p-invalid">{{ form.errors.first('name') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Email</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="email"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.email"
                            placeholder="Email"
                            :class="{ 'p-invalid': form.errors.has('email')}"/>
                        <small id="email-help" class="p-invalid">{{ form.errors.first('email') }}</small>
                    </div>
                </div>

                <div v-if="canChangePassword">
                    <Button label="Change Password" class="p-button-danger" @click="changePassword = true"/>
                </div>


                <div v-else>

                    <div class="form-group row mb-2">
                        <label class="col-form-label col-md-3 required">Password</label>
                        <div class="col-md-9 grid p-fluid">

                            <Password
                                v-model="form.password"
                                placeholder="Password"
                                toggleMask
                                :class="{ 'p-invalid': form.errors.has('password')}"
                            />


                            <small id="password-help" class="p-invalid">{{ form.errors.first('password') }}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 required">Password Confirmation</label>
                        <div class="col-md-9 grid p-fluid">

                            <Password
                                v-model="form.password_confirmation"
                                placeholder="Password Confirmation"
                                toggleMask
                                :class="{ 'p-invalid': form.errors.has('password_confirmation')}"
                            />
                            <small id="password_confirmation-help" class="p-invalid">{{ form.errors.first('password_confirmation') }}</small>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </form>
</template>

<script>
import Form from "form-backend-validation";

export default {
    name: "UserForm",

    data: () => ({
        form: new Form({
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
        }),

        changePassword: false
    }),

    computed : {
        canChangePassword(){
            console.log(this.$route.params.id !== undefined || this.changePassword);
            return this.$route.params.id !== undefined && !this.changePassword
        }
    },

    async mounted() {
        if(this.$route.params.id){
            await this.fetch();
        }
    },

    methods : {
        async fetch(){
            const response = await this.$http.get('/api/users/' + this.$route.params.id);
            this.form.populate(response.data.data);
        },

        async submit() {
            this.$route.params.id
                ? await this.update()
                : await this.store();
        },

        async store() {
            try {
                await this.form.post('/api/users');
                await this.$router.push({ name: 'users.grid' });
            } catch (error) {
                if(error.response.status !== 422){

                }
            }
        },

        async update() {
            try {
                await this.form.put('/api/users/' + this.$route.params.id);
                await this.$router.push({ name: 'users.grid' });
            } catch (error) {
                if(error.response.status !== 422){

                }
            }
        },

        back(){
            this.$router.push({ name: 'users.grid' });
        }
    }
}
</script>
