<template>
    <div class="admin-page">
        <div class="container">
            <div class="my-services-menu-wrapper">
                <h3 class="my-services-menu-title section-title">Список сервисов</h3>
                <div class="thick-frame">
                    <SelectTypeBand :types="carservices"
                                    :currentType="currentService.name"
                                    @setNewCurrentType="setNewCurrentService"
                                    :disabled="editMode"
                    ></SelectTypeBand>
                </div>
                <div class="my-services-menu-add-new">Добавить сервис</div>
            </div>
            <div class="services-info-wrapper">
                <h3 class="services-info-title section-title">{{ currentService.name }}</h3>
                <!-- Переключатель вкладок -->
                <SelectTypeBand :types="bookmarks"
                                :currentType="currentBookmark"
                                @setNewCurrentType="setNewBookmark"
                                :disabled="editMode"
                ></SelectTypeBand>
                <!--Вкладка-->
                <div class="thick-frame move-up17">
                    <component :is="currentPage"></component>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import SelectTypeBand from './UI/SelectTypeBand'
import ScheduleOwnerTab from "./UI/ScheduleOwnerTab"
import ServiceCommonEditor from "./UI/ServiceCommonEditor";

export default {
    data() {
        return {
            bookmarks: [
                {name: 'Общая информация'},
                {name: 'Расписание'},
            ],
            currentBookmark: 'Общая информация',
            //Если информация по сервису в режиме редактирования/вставки, нельзя переключаться на другие сервисы или вкладки
            editMode: true,
        }
    },
    methods: {
        setNewCurrentService(newCurrentService) {
            if (!this.editMode) this.$store.dispatch('owner/findOwnerServiceByName',newCurrentService)
        },

        setNewBookmark(newCurrentBM) {
            if (!this.editMode) this.currentBookmark = newCurrentBM
        },
    },
    computed: {
        currentPage() {
            return (this.currentBookmark === 'Общая информация') ? ServiceCommonEditor : ScheduleOwnerTab
        },
        carservices() {
          return this.$store.state.owner.carServiceList
        },
        currentService() {
            return this.$store.state.currentService.commonInfo
        },
        allTypes() {
            return this.$store.state.types
        },
    },
    components: {
        SelectTypeBand,
        ServiceCommonEditor,
        ScheduleOwnerTab,
    },
    async mounted() {
        await this.$store.dispatch('owner/getServicesInfo')
    },


}

</script>

<style>

</style>
