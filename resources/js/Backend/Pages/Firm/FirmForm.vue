<template>
  <form @submit.prevent="submit">
    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        {{ $t('firm.title') }} / {{ createOrEditPage }}
      </h4>

      <div class="float-end">
        <Button class="p-button-sm p-button-secondary p-button-outlined" :label="$t('messages.buttons.cancel')" @click="back" />
        <Button type="submit" :label="$t('messages.buttons.save')" class="p-button-sm" />
      </div>
    </div>

    <div class="row">
      <div class="col-8 mx-auto">
        <div class="form-group row mb-2">
          <label class="col-form-label col-md-3 required">{{ $t('firm.form.image') }}</label>
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
                {{ $t('firm.form.choose') }}
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
          <label class="col-form-label col-md-3 required">{{ $t('firm.form.name') }}</label>
          <div class="col-md-9 grid p-fluid">
            <InputText
              id="name"
              v-model="form.name"
              class="p-inputtext-sm"
              type="text"
              placeholder="Name"
              :class="{ 'p-invalid': form.errors.has('name')}"
            />
            <small id="name-help" class="p-invalid">{{ form.errors.first('name') }}</small>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import Form from 'form-backend-validation';

export default {
    name: 'FirmForm',

    data: () => ({
        form: new Form({
            id: null,
            name: null,
            image: null
        }),

        imageData: null,

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
    },

    methods : {
        async fetch(){
            const response = await this.$http.get('/api/firms/' + this.$route.params.id);
            this.form.populate(response.data.data);

            if(this.form.image){
                this.imageData = '/images/' + this.form.image;
            }
            this.form.image = null;
        },

        async submit() {
            this.$route.params.id
                ? await this.update()
                : await this.store();
        },

        async store() {
            try {
                await this.form.post('/api/firms');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('firm.messages.created'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'firms.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('firm.messages.not_created'), life: 2000 });
                }
            }
        },

        async update() {
            try {
                await this.form.post('/api/firms/' + this.$route.params.id);
                this.$toast.add({ severity:'success', detail: this.$i18n.t('firm.messages.updated'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'firms.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('firm.messages.not_updated'), life: 2000 });
                }
            }
        },

        back(){
            this.$router.push({ name: 'firms.grid' });
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
