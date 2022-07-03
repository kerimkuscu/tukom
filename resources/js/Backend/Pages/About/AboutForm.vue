<template>
  <div class="container-fluid">
    <div class="row justify-content-center m-2">
      <div class="card">
        <div class="card-body">
          <form @submit.prevent="submit">
            <div class="pb-5" style="margin-bottom: 20px">
              <h4 class="float-start card-title">
                {{ $t('about.title') }}
              </h4>

              <div class="float-end">
                <Button type="submit" :label="$t('messages.buttons.save')" class="p-button-sm" />
              </div>
            </div>

            <div class="row">
              <div class="col-8 mx-auto">
                <div class="form-group row">
                  <div class="grid p-fluid">
                    <Editor v-model="form.about" editor-style="height: 320px" />
                  </div>
                </div>
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
    name: 'AboutForm',

    data: () => ({
        form: new Form({
            about: null,
        }, {
            resetOnSuccess: false
        }),
    }),

    async mounted() {
        await this.fetch();
    },

    methods : {
        async fetch(){
            const response = await this.$http.get('/api/about');
            this.form.about = response.data.data;
        },

        async submit() {
            await this.update();
        },

        async update() {
            try {
                await this.form.post('/api/about');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('about.messages.updated'), life: 2000 });

            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('about.messages.not_updated'), life: 2000 });
                }
            }
        },
    }
}
</script>
