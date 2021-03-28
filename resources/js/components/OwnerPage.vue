<template>
    <div class="admin-page">
        <div class="container" @allowSwitching="setBlocked">
            <div class="my-services-menu-wrapper">
                <h3 class="my-services-menu-title section-title">Список сервисов</h3>
                <div class="thick-frame">
                    <SelectTypeBand :types="carservices"
                                    :currentType="currentService.name"
                                    @setNewCurrentType="setNewCurrentService"
                                    :blocked="blocked"
                    ></SelectTypeBand>
                </div>
                <div
                    class="my-services-menu-add-new"
                    :class="{
                    'disabled-btn': blocked,
                    }"
                    @click="startInsertService"
                >Добавить сервис
                </div>
            </div>
            <div class="services-info-wrapper">
                <h3 class="services-info-title section-title">{{ currentService.name }}</h3>
                <!-- Переключатель вкладок -->
                <SelectTypeBand :types="bookmarks"
                                :currentType="currentBookmark"
                                @setNewCurrentType="setNewBookmark"
                                :blocked="blocked"
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
import ServiceCommonEditor from "./UI/ServiceCommonEditor"


export default {
    data() {
        return {
            bookmarks: [
                {name: 'Общая информация'},
                {name: 'Расписание'},
            ],
            currentBookmark: 'Общая информация',
        }
    },
    methods: {
        setNewCurrentService(newCurrentService) {
            if (!this.blocked) this.$store.dispatch('owner/findOwnerServiceByName', newCurrentService)
        },

        setNewBookmark(newCurrentBM) {
            if (!this.blocked) this.currentBookmark = newCurrentBM
        },

        setBlocked(val) {
            this.blocked = val
        },

        startInsertService() {
            this.$store.dispatch('owner/insertEmptyService')
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
        //Если информация по сервису в режиме редактирования/вставки, нельзя переключаться на другие сервисы или вкладки
        blocked() {
            return this.$store.state.currentService.mode !== 'view'
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
