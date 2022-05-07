<template>
<div>
    <form @submit.prevent="submit">

        <div class="float-end">
            <Button label="Back" @click="back"/>

            <Button type="submit" label="Save" />
        </div>

    <div class="row">
        <div class="col-8 mx-auto">
            <div class="form-group row mb-2">
                <label class="col-form-label col-md-3 required">Parent Menu</label>
                <div class="col-md-9 grid p-fluid">
<!--                    <CascadeSelect v-model="form.parent_id" :options="countries" optionLabel="cname" optionGroupLabel="name"-->
<!--                                   :optionGroupChildren="['states', 'cities']" style="minWidth: 14rem" placeholder="Parent Menu" />-->

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
            parent_id: null,
            name: null,
        }),

        menuList: null,
        // deep: null,
        // menuList: null,
        // optionGroupChildren: [],
        //
        // countries: [
        //     {
        //         name: 'Australia',
        //         code: 'AU',
        //         states: [
        //             {
        //                 name: 'New South Wales',
        //                 cities: [
        //                     {cname: 'Sydney', code: 'A-SY'},
        //                     {cname: 'Newcastle', code: 'A-NE'},
        //                     {cname: 'Wollongong', code: 'A-WO'}
        //                 ]
        //             },
        //             {
        //                 name: 'Queensland',
        //                 cities: [
        //                     {cname: 'Brisbane', code: 'A-BR'},
        //                     {cname: 'Townsville', code: 'A-TO'}
        //                 ]
        //             },
        //
        //         ]
        //     },
        //     {
        //         name: 'Canada',
        //         code: 'CA',
        //         states: [
        //             {
        //                 name: 'Quebec',
        //                 cities: [
        //                     {cname: 'Montreal', code: 'C-MO'},
        //                     {cname: 'Quebec City', code: 'C-QU'}
        //                 ]
        //             },
        //             {
        //                 name: 'Ontario',
        //                 cities: [
        //                     {cname: 'Ottawa', code: 'C-OT'},
        //                     {cname: 'Toronto', code: 'C-TO'}
        //                 ]
        //             },
        //
        //         ]
        //     },
        //     {
        //         name: 'United States',
        //         code: 'US',
        //         states: [
        //
        //         ]
        //     }
        // ]
    }),

    async mounted() {
        if(this.$route.params.id){
            await this.fetch();
        }

        await this.getMenuTree()
       // await this.prepareOptionGroupChildren()
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
