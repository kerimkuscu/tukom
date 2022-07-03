<template>
  <Dialog :visible.sync="showModal" :container-style="{width: '30vw'}" :modal="true">
    <template #header>
      <h3>{{ $t('product.product_settings_title') }}</h3>
    </template>

    <div class="form-group row mb-2">
      <label class="col-form-label col-md-7" for="price" style="padding-top: 0">{{ $t('product.form.price') }}</label>
      <div class="col-md-5 grid p-fluid">
        <InputSwitch id="price" v-model="form.price" />
      </div>
    </div>

    <div class="form-group row mb-2">
      <label class="col-form-label col-md-7" for="fiili_stok" style="padding-top: 0">{{ $t('product.form.fiili_stok') }}</label>
      <div class="col-md-5 grid p-fluid">
        <InputSwitch id="fiili_stok" v-model="form.fiili_stok" />
      </div>
    </div>

    <div class="form-group row mb-2">
      <label class="col-form-label col-md-7" for="actual_stock" style="padding-top: 0">{{ $t('product.form.actual_stock') }}</label>
      <div class="col-md-5 grid p-fluid">
        <InputSwitch id="actual_stock" v-model="form.actual_stock" />
      </div>
    </div>

    <template #footer>
      <Button :label="$t('messages.buttons.cancel')" class="p-button-outlined p-button-secondary p-button-sm" @click="closeProductSettingsModal" />
      <Button :label="$t('messages.buttons.save')" class=" p-button-sm" @click="saveProductSettings" />
    </template>
  </Dialog>
</template>

<script>
import Form from 'form-backend-validation';

export default {
    name: 'ProductSettings',

    data:() => ({
        showModal: false,
        form: new Form({
            price: false,
            fiili_stok: false,
            actual_stock: false,
        }),
    }),

    mounted() {
        this.$eventHub.$on('products-settings', this.showProductSettingsModal);
    },

    methods: {
        async fetch(){
            const response = await this.$http.get('/api/settings/product');
            this.form.populate(response.data.data);
        },

        async showProductSettingsModal() {
            await this.fetch();

            this.showModal = true;
        },

        closeProductSettingsModal() {
            this.showModal = false;
        },

        async saveProductSettings() {
            try {
                await this.form.post('/api/settings/product');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('product.messages.setting_updated'), life: 2000 });

                this.closeProductSettingsModal();
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('product.messages.setting_not_updated'), life: 2000 });
                }
            }
        }
    }
}
</script>
