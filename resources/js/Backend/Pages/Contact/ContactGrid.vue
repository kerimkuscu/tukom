<template>
    <div>
        <ConfirmDialog />

        <div class="pb-5" style="margin-bottom: 20px">
            <h4 class="float-start card-title">
                Contacts
            </h4>
            <Button label="Create" class="float-end p-button-sm" @click="create" />
        </div>

        <DataTable
            ref="dt"
            data-key="id"
            responsive-layout="scroll"
            paginator-template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
            :value="items"
            :lazy="true"
            :paginator="true"
            :rows="perPage"
            :total-records="totalRecords"
            :loading="loading"
            @page="onPage($event)"
            @sort="onSort($event)"
        >
            <Column ref="name" field="name" header="Name" />
            <Column ref="email" field="email" header="Email" />
            <Column ref="phone" field="phone" header="Phone" />
            <Column ref="subject" field="subject" header="Subject" />
            <Column ref="message" field="message" header="Message" />
            <Column ref="message" field="message" header="Message" />

            <Column :body-style="{'text-align': 'center', overflow: 'visible'}">
                <template #body="{data}">
                    <Button icon="pi pi-trash" class="float-end p-button-sm p-button-danger" @click="remove(data.id)" />
                </template>
            </Column>

        </DataTable>
    </div>
</template>

<script>
export default {
    name: "ContactGrid",

    data: () => ({
        items: null,
        loading: false,
        totalRecords: 0,
        perPage: null,
        lazyParams: {},
    }),

    mounted() {
        this.lazyParams = {
            first: 1,
            rows: this.$refs.dt.rows,
            sortField: null,
            sortOrder: null,
            page: 0
        };

        this.fetch();
    },

    methods: {
        async fetch(){
            this.loading = true;

            const queryString = `?page=${this.lazyParams.page + 1 || ''}`;
            const response = await this.$http.get('/api/contacts' + queryString)

            this.items = response.data.data;
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

        create(){
            this.$router.push({ name: 'contacts.create' });
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
                    await this.$http.delete('/api/contacts/' + id)
                    await this.fetch()
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        },
    }
}
</script>
