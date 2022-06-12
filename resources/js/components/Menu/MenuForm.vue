<template>
<div>
    <form @submit.prevent="submit">

        <div class="pb-5" style="margin-bottom: 20px">
                <h4 class="float-start card-title">Menus / {{createOrEditPage}}</h4>

                <div class="float-end">
                    <Button class="p-button-sm p-button-secondary p-button-outlined" label="Cancel" @click="back"/>

                    <Button type="submit" label="Save" class="p-button-sm" />
                </div>
            </div>

    <div class="row">
        <div class="col-8 mx-auto">
            <div class="form-group row mb-2">
                <label class="col-form-label col-md-3">Parent Menu</label>
                <div class="col-md-9 grid p-fluid">

                    <Dropdown
                        v-model="form.parent_id"
                        :options="menuList"
                        optionLabel="text"
                        optionValue="value"
                        placeholder="Parent Menu"
                        :filter="true"
                    />

                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3 required">Name</label>
                <div class="col-md-9 grid p-fluid">
                    <InputText
                        id="name"
                        class="p-inputtext-sm"
                        type="text"
                        v-model="form.name"
                        placeholder="Name"
                        :class="{ 'p-invalid': form.errors.has('name')}"/>
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
    name: "MenuForm",

    data: () => ({
        form: new Form({
            id: null,
            parent_id: null,
            name: null,
        }),

        menuList: null,
    }),

    async mounted() {
        if(this.$route.params.id){
            await this.fetch();
        }

        await this.getMenuTree()
       // await this.prepareOptionGroupChildren()
    },

    computed: {
        createOrEditPage() {
            return this.form.id === null ? 'Create' : 'Edit';
        }
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
                await this.$router.push({ name: 'menus.grid' });
            } catch (error) {
                if(error.response.status !== 422){

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
                await this.$router.push({ name: 'menus.grid' });
            } catch (error) {
                if(error.response.status !== 422){

                }
            }
        },

        async getMenuTree(){
            const response = await this.$http.get('/api/menus/getMenuList');
            this.menuList = response.data.data;
            //this.deep = response.data.data.meta.deep;
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
