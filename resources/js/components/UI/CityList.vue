<template>

    <div>

        <div class="input-group">
            <input
                class="form-control py-2 border-right-0 border-left-0 border-top-0 bg-transparent"
                type="search" placeholder="Поиск по названию"
                id="example-search-input"
                v-model="searchStr">
            <span class="input-group-append">
                                      <div
                                          class="input-group-text bg-transparent border-right-0 border-left-0 border-top-0">
                                          <i class="fa fa-search"></i>
                                      </div>
                                </span>
        </div>
        <div class="city-list-container">
            <ul>
                <li v-for="(el,index) in filteredCities" :key="index" @click="setCity(el.city)">
                    {{el.city}}
                </li>
            </ul>
        </div>

    </div>

</template>


<script>

    export default {
        data: () => {
            return {
                searchStr: ''
            }
        },
        props: ['close'],
        methods: {
            setCity(aCity) {
                this.$store.commit('setCity', aCity)
                this.close()
            }
        },
        computed: {
            filteredCities: function () {
                return this.$store.state.cities.filter(
                    (element) => {
                        return (this.searchStr === '') ? true : (element.city.toUpperCase().indexOf(this.searchStr.toUpperCase()) > -1)
                    })
            },
        },
        mounted() {
        }
    }
</script>

<style>
    .city-list-container {
        columns: 150px 3;
        column-gap: 30px;
        column-rule: 1px solid #ccc;
        overflow: scroll;
    }

    .city-list-container > ul {
        padding: 10px 10px 10px 20px;
        height: 800px;

    }

    .city-list-container > ul > li {
        list-style-type: none;
    }
</style>
