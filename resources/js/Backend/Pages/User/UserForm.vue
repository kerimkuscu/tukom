<template>
  <form @submit.prevent="submit">
    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        {{ $t('users.title') }} / {{ createOrEditPage }}
      </h4>

      <div class="float-end">
        <Button class="p-button-sm p-button-secondary p-button-outlined" :label="$t('messages.buttons.cancel')" @click="back" />
        <Button type="submit" :label="$t('messages.buttons.save')" class="p-button-sm" />
      </div>
    </div>

    <div class="row">
      <div class="col-8 mx-auto">
        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('users.form.name') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="name"
              v-model="form.name"
              class="p-inputtext-sm"
              type="text"
              :placeholder="$t('users.form.name')"
              :class="{ 'p-invalid': form.errors.has('name')}"
            />
            <small id="name-help" class="p-invalid">{{ form.errors.first('name') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('users.form.email') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="email"
              v-model="form.email"
              class="p-inputtext-sm"
              type="text"
              :placeholder="$t('users.form.email')"
              :class="{ 'p-invalid': form.errors.has('email')}"
            />
            <small id="email-help" class="p-invalid">{{ form.errors.first('email') }}</small>
          </div>
        </div>

        <div v-if="canChangePassword">
          <Button :label="$t('users.form.change_password')" class="p-button-sm p-button-danger p-button-outlined" @click="changePassword = true" />
        </div>

        <div v-else>
          <div class="form-group row mb-2">
            <label class="col-form-label col-md-3 required">{{ $t('users.form.password') }}</label>
            <div class="col-md-9 grid p-fluid">
              <Password
                v-model="form.password"
                :placeholder="$t('users.form.password')"
                toggle-mask
                :class="{ 'p-invalid': form.errors.has('password')}"
                class="p-inputtext-sm"
              />

              <small id="password-help" class="p-invalid">{{ form.errors.first('password') }}</small>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 required">{{ $t('users.form.password_confirmation') }}</label>
            <div class="col-md-9 grid p-fluid">
              <Password
                v-model="form.password_confirmation"
                :placeholder="$t('users.form.password_confirmation')"
                toggle-mask
                :class="{ 'p-invalid': form.errors.has('password_confirmation')}"
                class="p-inputtext-sm"
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
import Form from 'form-backend-validation';

export default {
    name: 'UserForm',

    data: () => ({
        form: new Form({
            id: null,
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
        },

        createOrEditPage() {
            return this.form.id === null ? this.$i18n.t('messages.buttons.create') : this.$i18n.t('messages.buttons.edit');
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
                this.$toast.add({ severity:'success', detail: this.$i18n.t('users.messages.created'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'users.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422){
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('users.messages.not_created'), life: 2000 });
                }
            }
        },

        async update() {
            try {
                await this.form.put('/api/users/' + this.$route.params.id);
                this.$toast.add({ severity:'success', detail: this.$i18n.t('users.messages.updated'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'users.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422){
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('users.messages.not_updated'), life: 2000 });
                }
            }
        },

        back(){
            this.$router.push({ name: 'users.grid' });
        }
    }
}
</script>
