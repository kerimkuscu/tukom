<template>
<div>
    <Button label="Back" class="float-end" />
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="form-group row mb-2">
                <label class="col-form-label col-md-3 required">Parent Menu</label>
                <div class="col-md-9 grid">
                    <CascadeSelect v-model="selectedMenu" :options="countries" optionLabel="cname" optionGroupLabel="name"
                                   :optionGroupChildren="['states', 'cities']" style="minWidth: 14rem" placeholder="Parent Menu" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3 required">Name</label>
                <div class="col-md-9 grid p-fluid">
                    <InputText id="username" class="p-inputtext-sm p-invalid" type="text" v-model="name" placeholder="Name" />
                    <small id="username2-help" class="p-invalid">Username is not available.</small>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "MenuForm",

    data: () => ({
      name: null,

        selectedMenu: null,

        countries: [
            {
                name: 'Australia',
                code: 'AU',
                states: [
                    {
                        name: 'New South Wales',
                        cities: [
                            {cname: 'Sydney', code: 'A-SY'},
                            {cname: 'Newcastle', code: 'A-NE'},
                            {cname: 'Wollongong', code: 'A-WO'}
                        ]
                    },
                    {
                        name: 'Queensland',
                        cities: [
                            {cname: 'Brisbane', code: 'A-BR'},
                            {cname: 'Townsville', code: 'A-TO'}
                        ]
                    },

                ]
            },
            {
                name: 'Canada',
                code: 'CA',
                states: [
                    {
                        name: 'Quebec',
                        cities: [
                            {cname: 'Montreal', code: 'C-MO'},
                            {cname: 'Quebec City', code: 'C-QU'}
                        ]
                    },
                    {
                        name: 'Ontario',
                        cities: [
                            {cname: 'Ottawa', code: 'C-OT'},
                            {cname: 'Toronto', code: 'C-TO'}
                        ]
                    },

                ]
            },
            {
                name: 'United States',
                code: 'US',
                states: [
                    {
                        name: 'California',
                        cities: [
                            {cname: 'Los Angeles', code: 'US-LA'},
                            {cname: 'San Diego', code: 'US-SD'},
                            {cname: 'San Francisco', code: 'US-SF'}
                        ]
                    },
                    {
                        name: 'Florida',
                        cities: [
                            {cname: 'Jacksonville', code: 'US-JA'},
                            {cname: 'Miami', code: 'US-MI'},
                            {cname: 'Tampa', code: 'US-TA'},
                            {cname: 'Orlando', code: 'US-OR'}
                        ]
                    },
                    {
                        name: 'Texas',
                        cities: [
                            {cname: 'Austin', code: 'US-AU'},
                            {cname: 'Dallas', code: 'US-DA'},
                            {cname: 'Houston', code: 'US-HO'}
                        ]
                    }
                ]
            }
        ]
    })
}
</script>
