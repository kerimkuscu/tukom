<template>
  <Dialog :visible.sync="showModal" :container-style="{width: '30vw'}" :modal="true">
    <template #header>
      <h3>{{ $t('contact.backend.contact_settings') }}</h3>
    </template>

    <div class="form-group row mb-2">
      <label class="col-form-label col-md-5" for="price" style="padding-top: 0">{{ $t('contact.backend.columns.email') }}</label>
      <div class="col-md-7 grid p-fluid">
        <InputText
          id="email"
          v-model="form.contact_email"
          class="p-inputtext-sm"
          type="text"
          :placeholder="$t('contact.frontend.email')"
        />
          <small id="email-help" class="p-invalid">{{ form.errors.first('contact_email') }}</small>
      </div>
    </div>

    <template #footer>
      <Button :label="$t('messages.buttons.cancel')" class="p-button-outlined p-button-secondary p-button-sm" @click="closeContactSettingsModal" />
      <Button :label="$t('messages.buttons.save')" class=" p-button-sm" @click="saveContactSettings" />
    </template>
  </Dialog>
</template>

<script>
import Form from 'form-backend-validation';

export default {
    name: 'ContactSettings',

    data:() => ({
        showModal: false,
        form: new Form({
            contact_email:null
        }),
    }),

    mounted() {
        this.$eventHub.$on('contact-settings', this.showContactSettingsModal);
    },

    methods: {
        async fetch(){
            const response = await this.$http.get('/api/settings/contact-email');
            this.form.populate(response.data.data);
        },

        async showContactSettingsModal() {
            await this.fetch();

            this.showModal = true;
        },

        closeContactSettingsModal() {
            this.showModal = false;
        },

        async saveContactSettings() {
            try {
                await this.form.post('/api/settings/contact-email');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('contact.backend.messages.setting_updated'), life: 2000 });

                this.closeContactSettingsModal();
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('contact.backend.messages.setting_not_updated'), life: 2000 });
                }
            }
        }
    }
}
</script>
