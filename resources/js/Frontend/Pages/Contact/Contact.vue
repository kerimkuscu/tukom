<template>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
        <div class="mapouter">
          <div class="gmap_canvas">
            <iframe
              id="gmap_canvas"
              width="900"
              height="900"
              src="https://maps.google.com/maps?q=Mimar%20Sinan%20Mah.%201.%C3%87akmak%20Sokak%20No%20:%209-11%20Kemerburgaz%20Ey%C3%BCpsultan%20%C4%B0stanbul&t=&z=15&ie=UTF8&iwloc=&output=embed"
              frameborder="0"
              scrolling="no"
              marginheight="0"
              marginwidth="0"
            />
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div style="margin-top: 10rem">
          <div class="justify-content-center" style="display: flex; margin: 1rem">
            <h3>{{ $t('navbar.headers.contact') }}</h3>
          </div>
          <form @submit.prevent="submit">
            <div class="row">
              <div class="col-8 mx-auto">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('contact.frontend.name') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="name"
                      v-model="form.name"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('contact.frontend.name')"
                      :class="{ 'p-invalid': form.errors.has('name')}"
                    />
                    <small id="name-help" class="p-invalid">{{ form.errors.first('name') }}</small>
                  </div>
                </div>

                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('contact.frontend.email') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="email"
                      v-model="form.email"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('contact.frontend.email')"
                      :class="{ 'p-invalid': form.errors.has('email')}"
                    />
                    <small id="name-help" class="p-invalid">{{ form.errors.first('email') }}</small>
                  </div>
                </div>

                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('contact.frontend.phone') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="phone"
                      v-model="form.phone"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('contact.frontend.phone')"
                      :class="{ 'p-invalid': form.errors.has('phone')}"
                    />
                    <small id="name-help" class="p-invalid">{{ form.errors.first('phone') }}</small>
                  </div>
                </div>
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('contact.frontend.subject') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="subject"
                      v-model="form.subject"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('contact.frontend.subject')"
                      :class="{ 'p-invalid': form.errors.has('subject')}"
                    />
                    <small id="name-help" class="p-invalid">{{ form.errors.first('subject') }}</small>
                  </div>
                </div>
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('contact.frontend.message') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <Textarea
                      id="message"
                      v-model="form.message"
                      :placeholder="$t('contact.frontend.message')"
                      :class="{ 'p-invalid': form.errors.has('message')}"
                      :auto-resize="true"
                      class="p-inputtextarea p-inputtext-sm p-inputtext p-component p-component"
                      rows="3"
                      cols="30"
                    />
                    <small id="name-help" class="p-invalid">{{ form.errors.first('message') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-0">
              <div class="offset-md-5">
                <Button type="submit" :label="$t('contact.frontend.send_email')" class="p-button-rounded w-25" icon="pi pi-send" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'form-backend-validation';

export default {
    name: 'Contact',

    data: () => ({
        form: new Form({
            name: null,
            email: null,
            phone: null,
            subject: null,
            message: null,
        }),

    }),

    methods: {
        async submit() {
            try {
                await this.form.post('/api/brands');
            } catch (error) {
                if(error.response.status !== 422) {

                }
            }
        },
    }
}
</script>
