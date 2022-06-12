<template>
    <div>
        <ConfirmDialog></ConfirmDialog>

        <div class="pb-5" style="margin-bottom: 20px">
            <h4 class="float-start card-title">Products</h4>
            <Button label="Create" @click="create" class="float-end p-button-sm" />

            <FileUpload
                mode="basic"
                :auto="true"
                chooseLabel="Import" name="demo[]"
                :customUpload="true"
                @uploader="importProducts"
                accept=".xlsx, .xls, .csv"
                style="float:right;padding-right: 3px;"
                buttonClass="p-button-sm p-button-outlined p-button-secondary"
            />
        </div>

        <DataTable
            ref="dt"
            dataKey="id"
            responsiveLayout="scroll"
            :scrollable="true"
            :rows="perPage"
            paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
            scrollHeight="1500px"
            scrollDirection="both"
            :resizableColumns="true"
            columnResizeMode="expand"
            :value="products"
            :lazy="true"
            :paginator="true"
            :totalRecords="totalRecords"
            :loading="loading"
            filterDisplay="row"
            :filters.sync="filters"
            :globalFilterFields="['name','email']"
            @page="onPage($event)"
            @sort="onSort($event)"
            @filter="onFilter($event)"
        >
            <Column field="card_code" header="Card Code" filterMatchMode="startsWith" ref="card_code" :sortable="true" :styles="{'min-width':'400px'}">
                <template #filter="{filterModel,filterCallback}">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by card code"/>
                </template>

                <template #body="slotProps">
                    <p :title="slotProps.data.card_code" class="truncate">{{ slotProps.data.card_code }} </p>
                </template>

                <template #body="slotProps">
                    <router-link :to="{ path: 'edit/' + slotProps.data.id }" >{{ slotProps.data.card_code }}</router-link>
                </template>
            </Column>

            <Column field="description" header="Description" filterField="description" filterMatchMode="contains" ref="description" :sortable="true" :styles="{'min-width':'400px'}">
                <template #filter="{filterModel,filterCallback}">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by description"/>
                </template>

                <template #body="slotProps">
                     <p :title="slotProps.data.description" class="truncate">{{ slotProps.data.description }} </p>
                </template>
            </Column>

            <Column field="type" header="Type" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.type" class="truncate">{{ slotProps.data.type }} </p>
                </template>
            </Column>

            <Column field="brand" header="Brand" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.brand" class="truncate">{{ slotProps.data.brand }} </p>
                </template>
            </Column>

            <Column field="fiili_stok" header="Fiili Stok" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.fiili_stok" class="truncate">{{ slotProps.data.fiili_stok }} </p>
                </template>
            </Column>

            <Column field="actual_stock" header="Actual stock" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.actual_stock" class="truncate">{{ slotProps.data.actual_stock }} </p>
                </template>
            </Column>

            <Column field="main_unit" header="Main Unit" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.main_unit" class="truncate">{{ slotProps.data.main_unit }} </p>
                </template>
            </Column>

            <Column field="price" header="Price" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.price" class="truncate">{{ slotProps.data.price }} </p>
                </template>
            </Column>

            <Column field="currency" header="Currency" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.currency" class="truncate">{{ slotProps.data.currency }} </p>
                </template>
            </Column>

            <Column field="group_code" header="Group Code" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.group_code" class="truncate">{{ slotProps.data.group_code }} </p>
                </template>
            </Column>

            <Column field="special_code_1" header="Special Code 1" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_1" class="truncate">{{ slotProps.data.special_code_1 }} </p>
                </template>
            </Column>

            <Column field="special_code_2" header="Special Code 2" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_2" class="truncate">{{ slotProps.data.special_code_2 }} </p>
                </template>
            </Column>

            <Column field="special_code_3" header="Special Code 3" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_3" class="truncate">{{ slotProps.data.special_code_3 }} </p>
                </template>
            </Column>

            <Column field="special_code_4" header="Special Code 4" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_4" class="truncate">{{ slotProps.data.special_code_4 }} </p>
                </template>
            </Column>

            <Column field="special_code_5" header="Special Code 5" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_5" class="truncate">{{ slotProps.data.special_code_5 }} </p>
                </template>
            </Column>

            <Column field="special_code_6" header="Special Code 6" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_6" class="truncate">{{ slotProps.data.special_code_6 }} </p>
                </template>
            </Column>

            <Column field="special_code_7" header="Special Code 7" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_7" class="truncate">{{ slotProps.data.special_code_7 }} </p>
                </template>
            </Column>

            <Column field="special_code_8" header="Special Code 8" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_8" class="truncate">{{ slotProps.data.special_code_8 }} </p>
                </template>
            </Column>

            <Column field="special_code_9" header="Special Code 9" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_9" class="truncate">{{ slotProps.data.special_code_9 }} </p>
                </template>
            </Column>

            <Column field="special_code_10" header="Special Code 10" :styles="{'min-width':'200px'}">
                <template #body="slotProps">
                    <p :title="slotProps.data.special_code_10" class="truncate">{{ slotProps.data.special_code_10 }} </p>
                </template>
            </Column>


            <Column :exportable="false" :styles="{'min-width':'8rem'}">
                <template #body="{data}">
                    <Button icon="pi pi-trash" class="p-button-sm p-button-danger" @click="remove(data.id)" />
                    <Button icon="pi pi-pencil" class="p-button-sm p-button-secondary p-button-outlined mx-lg-1" @click="edit(data.id)" />
                </template>
            </Column>

        </DataTable>

    </div>
</template>

<script>
export default {
    name: "ProductGrid",

    data: () => ({
        products: null,
        loading: false,
        totalRecords: 0,
        perPage: 10,
        lazyParams: {},

        filters: {
            'card_code': {value: '', matchMode: 'contains'},
            'description': {value: '', matchMode: 'contains'},
        },
    }),

    mounted() {
        this.lazyParams = {
            first: 1,
            rows: this.$refs.dt.rows,
            sortField: null,
            sortOrder: null,
            filters: this.filters,
            page: 0
        };

        this.fetch();
    },

    methods: {
        async fetch(){
            this.loading = true;

            const queryString = `?page=${this.lazyParams.page + 1 || ''}&sort=${this.lazyParams.sortField || '' }&sortOrder=${this.lazyParams.sortOrder || ''}&card_code=${this.lazyParams.filters.card_code.value || ''}&description=${this.lazyParams.filters.description.value || ''}`

            const response = await this.$http.get('/api/products' + queryString)

            this.products = response.data.data;
            this.totalRecords = response.data.meta.total
            this.perPage = response.data.meta.per_page

            this.loading = false;

        },

        onPage(event) {
            this.lazyParams = event;
            this.fetch();
        },

        onSort(event){
            this.lazyParams = event;
            this.fetch();
        },

        onFilter(event){
            this.lazyParams = event;
            this.fetch();
        },

        create(){
            this.$router.push({ name: 'products.create' });
        },

        edit(id){
            this.$router.push({ path: 'edit/' + id });
        },

        remove(id){
            this.$confirm.require({
                message: 'Are you sure you want to delete this record?',
                header: 'Confirmation',
                icon: 'pi pi-exclamation-triangle',
                accept: async () => {
                    await this.$http.delete('/api/products/' + id)
                    await this.fetch();
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        },

        importProducts(event){
            let formData = new FormData();
            let file = event.files[0];
            formData.append('file', file);

            console.log(file)

            this.$http.post('/api/products/import', formData,  {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
