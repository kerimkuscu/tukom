<template>
  <div>
    <form @submit.prevent="submit">
      <div class="pb-5" style="margin-bottom: 20px">
        <h4 class="float-start card-title">
          {{ $t('menu.title') }} / {{ createOrEditPage }}
        </h4>

        <div class="float-end">
          <Button class="p-button-sm p-button-secondary p-button-outlined" :label="$t('messages.buttons.cancel')" @click="back" />

          <Button type="submit" :label="$t('messages.buttons.save')" class="p-button-sm" />
        </div>
      </div>

      <div class="row">
        <div class="col-8 mx-auto">
          <div class="form-group row mb-2">
            <label class="col-form-label col-md-3">{{ $t('menu.form.parent_menu') }}</label>
            <div class="col-md-9 grid p-fluid">
              <Dropdown
                v-model="form.parent_id"
                :options="menuList"
                option-label="text"
                option-value="value"
                :placeholder="$t('menu.form.parent_menu')"
                :filter="true"
                class="p-inputtext-sm"
                :class="{ 'p-invalid': form.errors.has('parent_id')}"
              />

              <small id="parent-id-help" class="p-invalid">{{ form.errors.first('parent_id') }}</small>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 required">{{ $t('menu.form.name') }}</label>
            <div class="col-md-9 grid p-fluid">
              <InputText
                id="name"
                v-model="form.name"
                class="p-inputtext-sm"
                type="text"
                :placeholder="$t('menu.form.name')"
                :class="{ 'p-invalid': form.errors.has('name')}"
              />
              <small id="name-help" class="p-invalid">{{ form.errors.first('name') }}</small>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'form-backend-validation';

export default {
    name: 'MenuForm',

    data: () => ({
        form: new Form({
            id: null,
            parent_id: null,
            name: null,
        }),

        menuList: null,
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

        await this.getMenuTree()
    },

    methods : {
        async submit() {
            this.$route.params.id
                ? await this.update()
                : await this.store();
        },

        async store() {
            try {
                await this.form.post('/api/menus');
                this.$toast.add({ severity:'success', detail: this.$i18n.t('menu.messages.created'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'menus.grid' })
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('menu.messages.not_created'), life: 2000 });
                }
            }
        },

        async fetch(){
            const response = await this.$http.get('/api/menus/' + this.$route.params.id);
            this.form.populate(response.data.data);
        },

        async update() {
            try {
                await this.form.put('/api/menus/' + this.$route.params.id);
                this.$toast.add({ severity:'success', detail: this.$i18n.t('menu.messages.updated'), life: 2000 });
                setTimeout(() => {
                    this.$router.push({ name: 'menus.grid' })
                }, 500);
            } catch (error) {
                if(error.response.status !== 422) {
                    this.$toast.add({ severity:'error', detail: this.$i18n.t('menu.messages.not_updated'), life: 2000 });
                }
            }
        },

        async getMenuTree(){
            const response = await this.$http.get('/api/menus/getMenuList');
            this.menuList = response.data.data;
        },

        async prepareOptionGroupChildren(){
          for(let i = 0; i < this.deep; i++){
              this.optionGroupChildren.push('childrens')
          }
        },

        back(){
            this.$router.push({ name: 'menus.grid' });
        }
    }
}
</script>
