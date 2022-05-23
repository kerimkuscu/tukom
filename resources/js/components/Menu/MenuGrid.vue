<template>
    <div>
        <ConfirmDialog></ConfirmDialog>

        <div class="pb-5">
            <Button label="Create" @click="create" class="float-end" />
        </div>
        <TreeTable v-if="menus.length > 0" :value="menus">
            <Column field="name" header="Name" :expander="true"></Column>

            <Column :bodyStyle="{'text-align': 'center', overflow: 'visible'}" >
                <template #body="item">
                    <Button type="button" icon="pi pi-trash" class="p-button-danger float-end" @click="remove(item.node.data.id)" />
                    <Button type="button" icon="pi pi-pencil" class="p-button-warning float-end" @click="edit(item.node.data.id)" />
                </template>
            </Column>
        </TreeTable>
        <div v-else>
            <div class="alert alert-warning" role="alert">
                There is no record to display
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Menus",

    data: () => ({
       menus: null,

        // nodes: [
        //         {"key":"0","data":{"name":"Applications","size":"100kb","type":"Folder"},"children":[{"key":"0-0","data":{"name":"Vue","size":"25kb","type":"Folder"},"children":[{"key":"0-0-0","data":{"name":"vue.app","size":"10kb","type":"Application"}},{"key":"0-0-1","data":{"name":"native.app","size":"10kb","type":"Application"}},{"key":"0-0-2","data":{"name":"mobile.app","size":"5kb","type":"Application"}}]},{"key":"0-1","data":{"name":"editor.app","size":"25kb","type":"Application"}},{"key":"0-2","data":{"name":"settings.app","size":"50kb","type":"Application"}}]},
        //         {"key":"1","data":{"name":"Cloud","size":"20kb","type":"Folder"},"children":[{"key":"1-0","data":{"name":"backup-1.zip","size":"10kb","type":"Zip"}},{"key":"1-1","data":{"name":"backup-2.zip","size":"10kb","type":"Zip"}}]},
        //         {"key":"2","data":{"name":"Desktop","size":"150kb","type":"Folder"},"children":[{"key":"2-0","data":{"name":"note-meeting.txt","size":"50kb","type":"Text"}},{"key":"2-1","data":{"name":"note-todo.txt","size":"100kb","type":"Text"}}]},
        //         {"key":"3","data":{"name":"Documents","size":"75kb","type":"Folder"},"children":[{"key":"3-0","data":{"name":"Work","size":"55kb","type":"Folder"},"children":[{"key":"3-0-0","data":{"name":"Expenses.doc","size":"30kb","type":"Document"}},{"key":"3-0-1","data":{"name":"Resume.doc","size":"25kb","type":"Resume"}}]},{"key":"3-1","data":{"name":"Home","size":"20kb","type":"Folder"},"children":[{"key":"3-1-0","data":{"name":"Invoices","size":"20kb","type":"Text"}}]}]},
        //         {"key":"4","data":{"name":"Downloads","size":"25kb","type":"Folder"},"children":[{"key":"4-0","data":{"name":"Spanish","size":"10kb","type":"Folder"},"children":[{"key":"4-0-0","data":{"name":"tutorial-a1.txt","size":"5kb","type":"Text"}},{"key":"4-0-1","data":{"name":"tutorial-a2.txt","size":"5kb","type":"Text"}}]},{"key":"4-1","data":{"name":"Travel","size":"15kb","type":"Text"},"children":[{"key":"4-1-0","data":{"name":"Hotel.pdf","size":"10kb","type":"PDF"}},{"key":"4-1-1","data":{"name":"Flight.pdf","size":"5kb","type":"PDF"}}]}]},
        //         {"key":"5","data":{"name":"Main","size":"50kb","type":"Folder"},"children":[{"key":"5-0","data":{"name":"bin","size":"50kb","type":"Link"}},{"key":"5-1","data":{"name":"etc","size":"100kb","type":"Link"}},{"key":"5-2","data":{"name":"var","size":"100kb","type":"Link"}}]},
        //         {"key":"6","data":{"name":"Other","size":"5kb","type":"Folder"},"children":[{"key":"6-0","data":{"name":"todo.txt","size":"3kb","type":"Text"}},{"key":"6-1","data":{"name":"logo.png","size":"2kb","type":"Picture"}}]},
        //         {"key":"7","data":{"name":"Pictures","size":"150kb","type":"Folder"},"children":[{"key":"7-0","data":{"name":"barcelona.jpg","size":"90kb","type":"Picture"}},{"key":"7-1","data":{"name":"primeng.png","size":"30kb","type":"Picture"}},{"key":"7-2","data":{"name":"prime.jpg","size":"30kb","type":"Picture"}}]},
        //         {"key":"8","data":{"name":"Videos","size":"1500kb","type":"Folder"},"children":[{"key":"8-0","data":{"name":"primefaces.mkv","size":"1000kb","type":"Video"}},{"key":"8-1","data":{"name":"intro.avi","size":"500kb","type":"Video"}}]}
        //     ]

    }),

    mounted() {
      this.fetch();
    },

    methods: {
        async fetch(){
            const response = await this.$http.get('/api/menus')
            this.menus = response.data.data;
        },

        create(){
            this.$router.push({ name: 'menus.create' });
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
                    await this.$http.delete('/api/menus/' + id)
                    await this.fetch()
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        }
    }
}
</script>
