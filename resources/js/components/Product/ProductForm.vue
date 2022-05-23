<template>
    <form @submit.prevent="submit">
        <div class="float-end">
            <Button label="Back" @click="back"/>

            <Button type="submit" label="Save" />
        </div>

        <div class="row">
            <div class="col-8 mx-auto">
                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Card Code</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="cardCode"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.card_code"
                            placeholder="Card Code"
                            :class="{ 'p-invalid': form.errors.has('card_code')}"/>
                        <small id="card-code-help" class="p-invalid">{{ form.errors.first('card_code') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Description</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="description"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.description"
                            placeholder="Description"
                            :class="{ 'p-invalid': form.errors.has('description')}"/>
                        <small id="description-help" class="p-invalid">{{ form.errors.first('description') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Type</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="description"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.type"
                            placeholder="Type"
                            :class="{ 'p-invalid': form.errors.has('type')}"/>
                        <small id="type-help" class="p-invalid">{{ form.errors.first('type') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Brand</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="brand"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.brand"
                            placeholder="Brand"
                            :class="{ 'p-invalid': form.errors.has('brand')}"/>
                        <small id="brand-help" class="p-invalid">{{ form.errors.first('brand') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Fiili Stok</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="fiili_stok"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.fiili_stok"
                            placeholder="Fiili Stok"
                            :class="{ 'p-invalid': form.errors.has('fiili_stok')}"/>
                        <small id="fiili-stok-help" class="p-invalid">{{ form.errors.first('fiili_stok') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Actual Stoct</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="actual_stock"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.actual_stock"
                            placeholder="Actual Stock"
                            :class="{ 'p-invalid': form.errors.has('actual_stock')}"/>
                        <small id="actual-stoct-help" class="p-invalid">{{ form.errors.first('actual_stock') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Main Unit</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="main_unit"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.main_unit"
                            placeholder="Main Unit"
                            :class="{ 'p-invalid': form.errors.has('main_unit')}"/>
                        <small id="main-unit-help" class="p-invalid">{{ form.errors.first('main_unit') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Price</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="price"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.price"
                            placeholder="Price"
                            :class="{ 'p-invalid': form.errors.has('price')}"/>
                        <small id="price-unit-help" class="p-invalid">{{ form.errors.first('price') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Currency</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="currency"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.currency"
                            placeholder="Currency"
                            :class="{ 'p-invalid': form.errors.has('currency')}"/>
                        <small id="currency-unit-help" class="p-invalid">{{ form.errors.first('currency') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Group Code</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="group_code"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.group_code"
                            placeholder="Group Code"
                            :class="{ 'p-invalid': form.errors.has('group_code')}"/>
                        <small id="group-code-unit-help" class="p-invalid">{{ form.errors.first('group_code') }}</small>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-form-label col-md-3 required">Special Code 1</label>
                    <div class="col-md-9 grid p-fluid">
                        <InputText
                            id="special_code1"
                            class="p-inputtext-sm"
                            type="text"
                            v-model="form.special_code1"
                            placeholder="Special Code 1"
                            :class="{ 'p-invalid': form.errors.has('special_code1')}"/>
                        <small id="special-code1-unit-help" class="p-invalid">{{ form.errors.first('special_code1') }}</small>
                    </div>
                </div>

            </div>
        </div>
    </form>
</template>

<script>
import Form from "form-backend-validation";

export default {
    name: "ProductForm",

    data: () => ({
        form: new Form({
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
        })
    }),

    async mounted() {
        if(this.$route.params.id){
            await this.fetch();
        }
    },

    methods : {
        async fetch(){
            const response = await this.$http.get('/api/products/' + this.$route.params.id);
            this.form.populate(response.data.data);
        },

        async submit() {
            this.$route.params.id
                ? await this.update()
                : await this.store();
        },

        async store() {
            try {
                await this.form.post('/api/products');
                await this.$router.push({ name: 'products.grid' });
            } catch (error) {
                if(error.response.status !== 422){

                }
            }
        },

        async update() {
            try {
                await this.form.put('/api/products/' + this.$route.params.id);
                await this.$router.push({ name: 'products.grid' });
            } catch (error) {
                if(error.response.status !== 422){

                }
            }
        },

        back(){
            this.$router.push({ name: 'products.grid' });
        }
    }
}
</script>
