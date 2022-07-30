<template>
  <div class="justify-content-center">
    <div class="m-2">
      <h3>{{ $t('navbar.headers.quote_request') }}</h3>
    </div>
    <div>
      <form @submit.prevent="submit">
        <div class="row">
          <div class="col-8 mx-auto">
            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('quote.columns.first_name') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="first-name"
                      v-model="form.first_name"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.first_name')"
                      :class="{ 'p-invalid': form.errors.has('first_name')}"
                    />
                    <small id="first-name-help" class="p-invalid">{{ form.errors.first('first_name') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('quote.columns.last_name') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="last-name"
                      v-model="form.last_name"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.last_name')"
                      :class="{ 'p-invalid': form.errors.has('last_name')}"
                    />
                    <small id="last-name-help" class="p-invalid">{{ form.errors.first('last_name') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('quote.columns.title') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="title"
                      v-model="form.title"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.title')"
                      :class="{ 'p-invalid': form.errors.has('title')}"
                    />
                    <small id="title-help" class="p-invalid">{{ form.errors.first('title') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('quote.columns.business') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <Dropdown
                      id="business"
                      v-model="form.business"
                      class="p-inputtext-sm"
                      :options="businessOptions"
                      option-label="text"
                      :placeholder="$t('quote.columns.business')"
                    />
                    <small id="business-help" class="p-invalid">{{ form.errors.first('business') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('quote.columns.company') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="company"
                      v-model="form.company"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.company')"
                      :class="{ 'p-invalid': form.errors.has('company')}"
                    />
                    <small id="company-help" class="p-invalid">{{ form.errors.first('company') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.address') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="address"
                      v-model="form.address"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.address')"
                      :class="{ 'p-invalid': form.errors.has('address')}"
                    />
                    <small id="address-help" class="p-invalid">{{ form.errors.first('address') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.zip_code') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="zip-code"
                      v-model="form.city_state_zip_country"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.zip_code')"
                      :class="{ 'p-invalid': form.errors.has('city_state_zip_country')}"
                    />
                    <small id="zip-code-help" class="p-invalid">{{ form.errors.first('city_state_zip_country') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.phone') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="phone"
                      v-model="form.phone"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.phone')"
                      :class="{ 'p-invalid': form.errors.has('phone')}"
                    />
                    <small id="phone-help" class="p-invalid">{{ form.errors.first('phone') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.fax') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="fax"
                      v-model="form.fax"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.fax')"
                      :class="{ 'p-invalid': form.errors.has('fax')}"
                    />
                    <small id="fax-help" class="p-invalid">{{ form.errors.first('fax') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3 required">{{ $t('quote.columns.email') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="email"
                      v-model="form.email"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.email')"
                      :class="{ 'p-invalid': form.errors.has('email')}"
                    />
                    <small id="email-help" class="p-invalid">{{ form.errors.first('email') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.connect_interested_pn') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="connector-interested"
                      v-model="form.connector_interested_in"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.connect_interested_pn')"
                      :class="{ 'p-invalid': form.errors.has('connector_interested_in')}"
                    />
                    <small id="connector-interested-help" class="p-invalid">{{ form.errors.first('connector_interested_in') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.current_connector_supplier') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="supplier"
                      v-model="form.connector_supplier"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.current_connector_supplier')"
                      :class="{ 'p-invalid': form.errors.has('connector_supplier')}"
                    />
                    <small id="supplier-help" class="p-invalid">{{ form.errors.first('connector_supplier') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.eau') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="eau"
                      v-model="form.eau"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.eau')"
                      :class="{ 'p-invalid': form.errors.has('eau')}"
                    />
                    <small id="eau-help" class="p-invalid">{{ form.errors.first('eau') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.project_title') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="project-title"
                      v-model="form.project_title"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.project_title')"
                      :class="{ 'p-invalid': form.errors.has('project_title')}"
                    />
                    <small id="project-title-help" class="p-invalid">{{ form.errors.first('project_title') }}</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 row">
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.project_start_date') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <InputText
                      id="start-date"
                      v-model="form.project_start_date"
                      class="p-inputtext-sm"
                      type="text"
                      :placeholder="$t('quote.columns.project_start_date')"
                      :class="{ 'p-invalid': form.errors.has('project_start_date')}"
                    />
                    <small id="start-date-help" class="p-invalid">{{ form.errors.first('project_start_date') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row mb-2">
                  <label class="col-form-label col-md-3">{{ $t('quote.columns.questions') }}</label>
                  <div class="col-md-9 grid p-fluid">
                    <Textarea
                      id="comments"
                      ref="comments"
                      :placeholder="$t('quote.columns.questions')"
                      :class="{ 'p-invalid': form.errors.has('questions_comments')}"
                      :auto-resize="true"
                      class="p-inputtextarea p-inputtext-sm p-inputtext p-component p-component"
                      rows="3"
                      cols="30"
                    />
                    <small id="comments-help" class="p-invalid">{{ form.errors.first('questions_comments') }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-0 mt-2">
          <div class="offset-md-4">
            <Button type="submit" :label="$t('contact.frontend.send_email')" class="p-button-rounded w-25" icon="pi pi-send" />
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'form-backend-validation';

export default {
    name: 'Quote',

    data: () => ({
        form: new Form({
            first_name: null,
            last_name: null,
            title: null,
            business: null,
            company: null,
            address: null,
            city_state_zip_country: null,
            phone: null,
            fax: null,
            email: null,
            connector_interested_in: null,
            connector_supplier: null,
            eau: null,
            project_title: null,
            project_start_date: null,
            questions_comments: null,
        }),

        businessOptions: [
            { text: 'Distributor', value: 'distributor' },
            { text: 'Contract Mfr.', value: 'contract' },
            { text: 'OEM', value: 'oem' },
        ]
    }),

    methods: {
        async submit() {
            try {
                this.form.questions_comments = this.$refs.comments.value;
                await this.form.post('/api/quotes');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('quote.messages.success'), life: 2000 });
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('quote.messages.error'), life: 2000 });
                }
            }
        },
    }
}
</script>
