<template>
  <form @submit.prevent="submit">
    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
          {{ $t('product.title') }} / {{ createOrEditPage }}
      </h4>

      <div class="float-end">
        <div class="float-end">
          <Button class="p-button-sm p-button-secondary p-button-outlined" :label="$t('messages.buttons.cancel')" @click="back" />

          <Button type="submit" :label="$t('messages.buttons.save')" class="p-button-sm" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-8 mx-auto">
        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('product.form.image') }}</label>
          <div class="col-md-9 grid p-fluid">
            <div
              class="image-input"
              :style="{ 'background-image': `url(${imageData})`, 'background-size': '100% 300px' }"
              :class="{ 'is-invalid': form.errors.has('image')}"
              @click="chooseImage"
            >
              <span
                v-if="!imageData"
                class="placeholder"
              >
                {{ $t('product.form.choose_an_image') }}
              </span>
              <input
                ref="fileInput"
                class="file-input"
                type="file"
                accept=".jpg,.png"
                @input="onSelectFile"
              >
            </div>

            <small id="image-help" class="invalid-feedback">{{ form.errors.first('image') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.menu') }}</label>
          <div class="col-md-9 grid p-fluid">
            <Dropdown
              v-model="form.menu_id"
              :options="menuList"
              option-label="text"
              option-value="value"
              :placeholder="this.$i18n.t('product.form.menu')"
              :filter="true"
              class="p-inputtext-sm"
            />
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('product.form.card_code') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="cardCode"
              v-model="form.card_code"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.card_code')"
              :class="{ 'p-invalid': form.errors.has('card_code')}"
            />
            <small id="card-code-help" class="p-invalid">{{ form.errors.first('card_code') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('product.form.description') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="description"
              v-model="form.description"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.description')"
              :class="{ 'p-invalid': form.errors.has('description')}"
            />
            <small id="description-help" class="p-invalid">{{ form.errors.first('description') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('product.form.type') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="description"
              v-model="form.type"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.type')"
              :class="{ 'p-invalid': form.errors.has('type')}"
            />
            <small id="type-help" class="p-invalid">{{ form.errors.first('type') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.brand') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="brand"
              v-model="form.brand"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.brand')"
              :class="{ 'p-invalid': form.errors.has('brand')}"
            />
            <small id="brand-help" class="p-invalid">{{ form.errors.first('brand') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.fiili_stok') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="fiili_stok"
              v-model="form.fiili_stok"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.fiili_stok')"
              :class="{ 'p-invalid': form.errors.has('fiili_stok')}"
            />
            <small id="fiili-stok-help" class="p-invalid">{{ form.errors.first('fiili_stok') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.actual_stock') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="actual_stock"
              v-model="form.actual_stock"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.actual_stock')"
              :class="{ 'p-invalid': form.errors.has('actual_stock')}"
            />
            <small id="actual-stoct-help" class="p-invalid">{{ form.errors.first('actual_stock') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.main_unit') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="main_unit"
              v-model="form.main_unit"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.main_unit')"
              :class="{ 'p-invalid': form.errors.has('main_unit')}"
            />
            <small id="main-unit-help" class="p-invalid">{{ form.errors.first('main_unit') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.price') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="price"
              v-model="form.price"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.price')"
              :class="{ 'p-invalid': form.errors.has('price')}"
            />
            <small id="price-unit-help" class="p-invalid">{{ form.errors.first('price') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.currency') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="currency"
              v-model="form.currency"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.currency')"
              :class="{ 'p-invalid': form.errors.has('currency')}"
            />
            <small id="currency-unit-help" class="p-invalid">{{ form.errors.first('currency') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.group_code') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="group_code"
              v-model="form.group_code"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.group_code')"
              :class="{ 'p-invalid': form.errors.has('group_code')}"
            />
            <small id="group-code-unit-help" class="p-invalid">{{ form.errors.first('group_code') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_1') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_1"
              v-model="form.special_code_1"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_1')"
              :class="{ 'p-invalid': form.errors.has('special_code_1')}"
            />
            <small id="special-code-1-unit-help" class="p-invalid">{{ form.errors.first('special_code_1') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_2') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_2"
              v-model="form.special_code_2"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_2')"
              :class="{ 'p-invalid': form.errors.has('special_code_2')}"
            />
            <small id="special-code-2-unit-help" class="p-invalid">{{ form.errors.first('special_code_2') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_3') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_3"
              v-model="form.special_code_3"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_3')"
              :class="{ 'p-invalid': form.errors.has('special_code_3')}"
            />
            <small id="special-code-3-unit-help" class="p-invalid">{{ form.errors.first('special_code_3') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_4') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_4"
              v-model="form.special_code_4"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_4')"
              :class="{ 'p-invalid': form.errors.has('special_code_4')}"
            />
            <small id="special-code-4-unit-help" class="p-invalid">{{ form.errors.first('special_code_4') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_5') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_5"
              v-model="form.special_code_5"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_5')"
              :class="{ 'p-invalid': form.errors.has('special_code_5')}"
            />
            <small id="special-code-5-unit-help" class="p-invalid">{{ form.errors.first('special_code_5') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_6') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_6"
              v-model="form.special_code_6"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_6')"
              :class="{ 'p-invalid': form.errors.has('special_code_6')}"
            />
            <small id="special-code-6-unit-help" class="p-invalid">{{ form.errors.first('special_code_6') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_7') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_7"
              v-model="form.special_code_7"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_7')"
              :class="{ 'p-invalid': form.errors.has('special_code_7')}"
            />
            <small id="special-code-7-unit-help" class="p-invalid">{{ form.errors.first('special_code_7') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_8') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_8"
              v-model="form.special_code_8"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_8')"
              :class="{ 'p-invalid': form.errors.has('special_code_8')}"
            />
            <small id="special-code-8-unit-help" class="p-invalid">{{ form.errors.first('special_code_8') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_9') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_9"
              v-model="form.special_code_9"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_9')"
              :class="{ 'p-invalid': form.errors.has('special_code_9')}"
            />
            <small id="special-code-9-unit-help" class="p-invalid">{{ form.errors.first('special_code_9') }}</small>
          </div>
        </div>

        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3">{{ $t('product.form.special_code_10') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="special_code_10"
              v-model="form.special_code_10"
              class="p-inputtext-sm"
              type="text"
              :placeholder="this.$i18n.t('product.form.special_code_10')"
              :class="{ 'p-invalid': form.errors.has('special_code_10')}"
            />
            <small id="special-code-10-unit-help" class="p-invalid">{{ form.errors.first('special_code_10') }}</small>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import Form from 'form-backend-validation';
import Toast from 'primevue/toast';

export default {
    name: 'ProductForm',

    components: {
      Toast
    },

    data: () => ({
        form: new Form({
            id: null,
            menu_id: null,
            image: null,
            card_code: null,
            description: null,
            type: null,
            brand: null,
            fiili_stok: null,
            actual_stock: null,
            main_unit: null,
            price: null,
            currency: null,
            group_code: null,
            special_code_1: null,
            special_code_2: null,
            special_code_3: null,
            special_code_4: null,
            special_code_5: null,
            special_code_6: null,
            special_code_7: null,
            special_code_8: null,
            special_code_9: null,
            special_code_10: null
        }),

        menuList: [],

        imageData: null
    }),

    computed: {
        createOrEditPage() {
            return this.form.id === null ? this.$i18n.t('messages.buttons.create') : this.$i18n.t('messages.buttons.edit');
        }
    },

    async mounted() {
        if(this.$route.params.id){
            await this.fetch();
        }

        await this.getMenus();
    },

    methods : {
        async fetch(){
            const response = await this.$http.get('/api/products/' + this.$route.params.id);
            this.form.populate(response.data.data);

            //'/images/1653505341.jpg'
            if(this.form.image){
                this.imageData = '/images/' + this.form.image;
            }

            this.form.image = null;
        },

        async getMenus(){
            const response = await this.$http.get('/api/menus/getMenuList')
            this.menuList = response.data.data;
        },

        async submit() {
            this.$route.params.id
                ? await this.update()
                : await this.store();
        },

        async store() {
            try {
                await this.form.post('/api/products');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('product.messages.created'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'products-list.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('product.messages.not_created'), life: 2000 });
                }
            }
        },

        async update() {
            try {
                await this.form.post('/api/products/' + this.$route.params.id);
                this.$toast.add({ severity:'success', detail: this.$i18n.t('product.messages.updated'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'products-list.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('product.messages.not_updated'), life: 2000 });
                }
            }
        },

        back(){
            this.$router.push({ name: 'products-list.grid' });
        },

        onFileChange(e){
            this.form.image = e.target.files[0];
        },

        chooseImage () {
            this.$refs.fileInput.click()
        },

        onSelectFile () {
            const input = this.$refs.fileInput
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.imageData = e.target.result
                    this.form.image = files[0];
                }
                reader.readAsDataURL(files[0])
                this.$emit('input', files[0])
            }
        }
    }
}
</script>

<style>
    .image-input{
        display: block;
        width: 75%;
        height: 300px;
        cursor: pointer;
        background-size: cover;
        background-position: center center;
    }
    .placeholder {
        background: #F0F0F0;
        width: 100%;

        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
        font-size: 18px;
        font-family: Helvetica;
    }

    .placeholder:hover {
        background: #E0E0E0
    }

    .file-input {
        display: none
    }
</style>
