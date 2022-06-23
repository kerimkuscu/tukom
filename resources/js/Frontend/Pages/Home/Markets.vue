<template>
    <div>
        <div class="align-items-center justify-content-center" style="display: flex; margin: 10px 0 10px 0">
            <h1>MARKETS</h1>
        </div>
        <div class="row col-md-12">
            <div v-for="item in items" class="col-md-3">
                <Card style="margin: 10px">
                    <template #header>
                        <img :alt="item.text" :src="item.path">
                    </template>
                    <template #title>
                        <div class="align-items-center justify-content-center" style="display: flex">
                            {{ item.text }}
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Markets',

    data:() => ({
        items: [
            { text: 'MILITARY', path: '/market-images/military.jpeg' },
            { text: 'AEROSPACE', path: '/market-images/aerospace.jpeg' },
            { text: 'AUTOMOTIVE', path: '/market-images/automotive.jpeg' },
            { text: 'RAILWAY', path: '/market-images/railway.jpeg' },
            { text: 'ELECTRICAL VEHICLES', path: '/market-images/electrical.jpeg' },
            { text: 'IT & DATA COMMUNICATION', path: '/market-images/data.jpeg' },
            { text: 'ENERGY AND UTILITIES', path: '/market-images/solar.jpeg' },
            { text: 'INDUSTRIAL', path: '/market-images/industrial.jpeg' },
        ],
    })
}
</script>
