<template>
    <div class="admin-page">
        <div class="container">
            <div class="my-services-menu-wrapper">
                <h3 class="my-services-menu-title section-title">Список сервисов</h3>
                <div class="thick-frame">
                    <SelectTypeBand :types="carservices" :currentType="currentService.name"
                                    @setNewCurrentType="setNewCurrentType"></SelectTypeBand>
                </div>
                <div class="my-services-menu-add-new">Добавить сервис</div>
            </div>
            <div class="services-info-wrapper">
                <h3 class="services-info-title section-title">{{ currentService.name }}</h3>
                <!-- Переключатель вкладок -->
                <SelectTypeBand :types="bookmarks" :currentType="currentBookmark"
                                @setNewCurrentType="setNewBookmark"></SelectTypeBand>
                <!--Вкладка-->
                <div class="thick-frame move-up17">
                    <component :is="currentPage"></component>
                </div>
                <div class="services-info-button-savechanges" id="services-info-button-savechanges">Сохранить
                    изменения
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SelectTypeBand from './UI/SelectTypeBand'
import ScheduleTab from "./UI/ScheduleTab"
import ServiceCommonEditor from "./UI/ServiceCommonEditor";

export default {
    data() {
        return {
            types: [
                {name: 'Шигномонтаж #12'},
                {name: 'Шиномонтаж №1'},
                {name: 'Автосервис 3'}
            ],
            bookmarks: [
                {name: 'Общая информация'},
                {name: 'Расписание'},
            ],
            currentBookmark: 'Общая информация',
        }
    },
    methods: {
        setNewCurrentType(newCurrentType) {
            this.currentType = newCurrentType
        },
        setNewBookmark(newCurrentBM) {
            this.currentBookmark = newCurrentBM
        },
    },
    computed: {
        currentPage() {
            return (this.currentBookmark === 'Общая информация') ? ServiceCommonEditor : ScheduleTab
        },
        carservices() {
          return this.$store.state.owner.carServiceList
        },
        currentService() {
            return this.$store.state.owner.currentService
        },
    },
    components: {
        SelectTypeBand,
        ServiceCommonEditor,
        ScheduleTab,
    },
    mounted() {
        this.$store.dispatch('owner/getServicesInfo')
    },


}

</script>

<style>

</style>
