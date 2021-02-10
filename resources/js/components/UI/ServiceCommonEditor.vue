<template>
    <div class="services-info-editor-el">
        <div class="services-info-layout-1">
            <div class="services-info-field">
                <div class="services-info-field-group">
                    <label for="services-info-field-input-company-name"
                           class="services-info-field-label">Наименование</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-company-name"
                           v-model="currentService.name">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-city" class="services-info-field-label">Город:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-city"
                           v-model="currentService.city"
                    >
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-street" class="services-info-field-label">Улица, дом /
                        строение:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-street"
                           v-model="currentService.address"
                    >
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-phone" class="services-info-field-label">Телефон:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-phone"
                           v-model="currentService.phone"
                    >
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-email" class="services-info-field-label">E-mail:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-email"
                           v-model="currentService.email"
                    >
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-telegram" class="services-info-field-label">Telegram:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-telegram"
                           v-model="currentService.telegram"
                    >
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-skype" class="services-info-field-label">Skype:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-skype"
                           v-model="currentService.skype"
                    >
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-website" class="services-info-field-label">Website:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-website"
                           v-model="currentService.site"
                    >
                </div>
                <label for="services-info-field-textarea" class="services-info-field-textarea-label">Общее
                    описание:</label>
                <textarea class="services-info-field-textarea"
                          id="services-info-field-textarea"
                          v-model="currentService.description"
                ></textarea>
            </div>
        </div>
        <div class="services-info-layout-2">
            <div class="services-info-types-wrapper">
                <h3 class="services-info-types-title">Оказываемые услуги</h3>
                <form class="services-info-types-list-form">
                    <div
                        class="services-info-types-list-form-group"
                        v-for="(type,index) in types" :key="type.id">
                        <label>
                            <input type="checkbox"
                                   class="services-info-types-list-checkbox"
                            v-model="type.inServiceList">
                            <span></span>
                            {{ type.name }}
                        </label>
                    </div>
                </form>
            </div>

            <div class="services-info-photo-wrapper">
                <h3 class="services-info-photo-title">Фотография</h3>
                <div class="services-info-photo-field">
                    <img :src="'storage/img/photos/'+currentService.img_link" alt="">
                    <div class="services-info-photo-field-placeholder">
                        Щелкните здесь чтобы добавить или изменить фото
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>


<script>
export default {
    props: ['description'],
    computed: {
        currentService() {
            return this.$store.state.owner.currentService
        },
        types() {
            let result=[]
            const sTypes=this.$store.state.owner.currentService.types
            this.$store.state.types.forEach(
                (el,index)=>{
                    if (index>0) {
                        el.inServiceList= (sTypes.findIndex(item => item.name===el.name)>-1)
                        result.push(el)

                    }
                }
            )
            return result

        }
    },
}
</script>
