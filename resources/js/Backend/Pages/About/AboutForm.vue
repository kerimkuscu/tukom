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
        }),

    }),

    async mounted() {
        if(this.$route.params.id){
            await this.fetch();
        }
    },

    methods : {
        async fetch(){
            const response = await this.$http.get('/api/abouts/' + this.$route.params.id);
            this.form.populate(response.data.data);
        },

        async submit() {
            this.$route.params.id
                ? await this.update()
                : await this.store();
        },

        async store() {
            try {
                await this.form.post('/api/abouts');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('about.messages.created'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'abouts.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('about.messages.not_created'), life: 2000 });
                }
            }
        },

        async update() {
            try {
                await this.form.put('/api/abouts/' + this.$route.params.id);
                this.$toast.add({ severity:'success', detail: this.$i18n.t('about.messages.updated'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'abouts.grid' });
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('about.messages.not_updated'), life: 2000 });
                }
            }
        },
    }
}
</script>
