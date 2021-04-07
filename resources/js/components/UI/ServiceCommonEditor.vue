<template>
    <div class="services-info-editor-el">
        <div class="services-info-layout-1">
            <div class="services-info-field">

                <input-group
                    :input-name="'service-name'"
                    :modal-value="currentService.name"
                    @input="value=>{currentService.name=value}"
                    @blur="$v.currentService.name.$touch()"
                    :label-text="'Наименование'"
                    :hasValidationErrors="($v.currentService.name.$dirty &&$v.currentService.name.$anyError)"
                    :error-messages="[
                        $v.currentService.name.$dirty && !$v.currentService.name.required ? 'Укажите название сервиса' : '',
                        $v.currentService.name.$dirty && !$v.currentService.name.minLength ?
                            'В названии сервиса должно быть хотя бы '+$v.currentService.name.$params.minLength.min+' символов':''
                    ]"
                />

                <input-group
                    :input-name="'service-city'"
                    :modal-value="currentService.city"
                    @input="value=>{currentService.city=value}"
                    @blur="$v.currentService.city.$touch()"
                    :label-text="'Город'"
                    :hasValidationErrors="($v.currentService.city.$dirty &&$v.currentService.city.$anyError)"
                    :error-messages="[
                        $v.currentService.city.$dirty && !$v.currentService.city.required ? 'Укажите название населенного пункта' : '',
                        $v.currentService.city.$dirty && !$v.currentService.city.minLength ?
                            'В названии населенного пункта должно быть хотя бы '+$v.currentService.city.$params.minLength.min+' символа' : ''
                    ]"
                />

                <input-group
                    :input-name="'service-address'"
                    :modal-value="currentService.address"
                    @input="value=>{currentService.address=value}"
                    @blur="$v.currentService.address.$touch()"
                    :label-text="'Улица, дом/строение'"
                    :hasValidationErrors="($v.currentService.address.$dirty &&$v.currentService.address.$anyError)"
                    :error-messages="[
                        $v.currentService.address.$dirty && !$v.currentService.address.required ? 'Укажите адрес (улица, дом)' : '',
                        $v.currentService.address.$dirty && !$v.currentService.address.minLength ?
                        'минимальная длина адреса - '+$v.currentService.address.$params.minLength.min+' символов' : ''
                    ]"
                />

                <input-group
                    :input-name="'service-phone'"
                    :modal-value="currentService.phone"
                    @input="value=>{currentService.phone=value}"
                    @blur="$v.currentService.phone.$touch()"
                    :label-text="'Телефон'"
                    :hasValidationErrors="($v.currentService.phone.$dirty &&$v.currentService.phone.$anyError)"
                    :error-messages="[
                        $v.currentService.phone.$dirty && !$v.currentService.phone.validPhone ? 'Укажите корректный номер телефона' : '',
                    ]"
                />

                <input-group
                    :input-name="'service-email'"
                    :modal-value="currentService.email"
                    @input="value=>{currentService.email=value}"
                    @blur="$v.currentService.email.$touch()"
                    :label-text="'E-mail'"
                    :hasValidationErrors="($v.currentService.email.$dirty &&$v.currentService.email.$anyError)"
                    :error-messages="[
                        $v.currentService.email.$dirty && !$v.currentService.email.email ? 'Укажите корректный адрес электроной почты' : '',
                    ]"
                />

                <input-group
                    :input-name="'service-telegram'"
                    :modal-value="currentService.telegram"
                    @input="value=>{currentService.telegram=value}"
                    @blur="$v.currentService.telegram.$touch()"
                    :label-text="'Телеграм'"
                    :hasValidationErrors="false"
                    :error-messages="[]"
                />


                <input-group
                    :input-name="'service-skype'"
                    :modal-value="currentService.skype"
                    @input="value=>{currentService.skype=value}"
                    @blur="$v.currentService.skype.$touch()"
                    :label-text="'Скайп'"
                    :hasValidationErrors="false"
                    :error-messages="[]"
                />

                <input-group
                    :input-name="'service-site'"
                    :modal-value="currentService.site"
                    @input="value=>{currentService.site=value}"
                    @blur="$v.currentService.site.$touch()"
                    :label-text="'Web-сайт'"
                    :hasValidationErrors="($v.currentService.site.$dirty && $v.currentService.site.$anyError)"
                    :error-messages="[
                        $v.currentService.site.$dirty && !$v.currentService.site.validSite ? 'Укажите корректный URL сайта Вашего сервиса' : ''
                    ]"
                />

                <label for="services-info-field-textarea" class="services-info-field-textarea-label">Общее
                    описание:</label>
                <textarea class="services-info-field-textarea"
                          id="services-info-field-textarea"
                          v-model="currentService.description"
                          @blur="$v.currentService.description.$touch()"
                          :class="{'invalid-data':
                          ($v.currentService.description.$dirty && $v.currentService.description.$error)}"
                ></textarea>
                <small class="error-notificator"
                       v-if="$v.currentService.description.$dirty && $v.currentService.description.$error">
                    Напишите краткое описание Вашего сервиса длиной не менее
                    {{ $v.currentService.description.$params.minLength.min }} символов
                </small>
            </div>
        </div>
        <div class="services-info-layout-2">
            <div class="services-info-types-wrapper">
                <h3 class="services-info-types-title">Оказываемые услуги</h3>
                <form class="services-info-types-list-form" :key="typesListKey">
                    <div
                        class="services-info-types-list-form-group"
                        v-for="(type,index) in types" :key="index">
                        <label :class="{'unchangable': type.hasTimeSlots}">
                            <input
                                type="checkbox"
                                class="services-info-types-list-checkbox"
                                :disabled="type.hasTimeSlots"
                                v-model="type.inServiceList"
                                @click="changeTypePosition"
                            >
                            <span></span>
                            {{ type.name }}
                        </label>
                    </div>
                </form>
            </div>

            <input-img-viewer :img_link="'storage/img/photos/'+currentService.img_link"/>

        </div>


        <div class="services-info-button-savechanges"
             :class="{'disabled-btn': mode==='view'||!ableToSave}"
             @click="saveChanges"
        >
            Сохранить изменения
        </div>

        <div class="services-info-button-cancel"
             :class="{'disabled-btn': mode==='view'}"
             @click="cancelEdit">
            Отмена
        </div>

    </div>
</template>


<script>
import {required, minLength, email, sameAs} from "vuelidate/lib/validators"
import inputGroup from "./inputGroup"
import inputImgViewer from "./inputImgViewer"
import currentService from "../../store/modules/currentService";

export default {

    components: {
        inputGroup,
        inputImgViewer
    },
    data() {
        return {
            //Ключ для перерисовки достуных типов услуг сервиса. Не хватает реактивности,
            // приходится использовать такие вещи
            typesListKey: 0,
        }
    },
    computed: {
        currentService() {
            return this.$store.state.currentService.commonInfo
        },
        types() {
            let result = []
            const sTypes = this.$store.state.currentService.types
            const schedules = this.$store.state.currentService.schedules
            if (!sTypes) return [] //Это если еще не прогрузился элемент

            this.$store.state.types.forEach(
                (el, index) => {
                    if (index > 0) {
                        if (sTypes.length > 0) {
                            el.inServiceList = (sTypes.findIndex(item => item.name === el.name) > -1)
                        } else {
                            el.inServiceList = false
                        }
                        //есть дочерние элементы, т.е. отключить такой элемент при редактировании просто так нельзя
                        el.hasTimeSlots = (schedules.findIndex(item => item.name === el.name) > -1)
                        result.push(el)

                    }
                }
            )
            return result
        },
        mode() { //в каком режиме находится компонент : редактирование, чтение или вставка
            return this.$store.state.currentService.mode
        },

        dirty() {
            return this.$v.currentService.$anyDirty
        },

        //Если true, то можно отжимать кнопку "Сохранить"
        ableToSave() {
            if (this.mode === 'edit') {
                return this.$v.currentService.$anyDirty && !this.$v.currentService.$anyError
            } else if (this.mode === 'insert') {
                return !this.$v.currentService.$anyError
            } else {
                return false
            }

        }
    },
    watch: {
        dirty: function (val) {
            if (val && this.mode === 'view') this.$store.dispatch('currentService/enterEditMode')
        },
    },
    validations: {
        currentService: {
            name: {
                required,
                minLength: minLength(10)
            },
            city: {
                required,
                minLength: minLength(2)
            },
            address: {
                required,
                minLength: minLength(25)
            },
            phone: {
                required,
                validPhone: val => {
                    let phoneTmpl = new RegExp('^((8|\\+7)[\\- ]?)?(\\(?\\d{3}\\)?[\\- ]?)?[\\d\\- ]{7,10}$')
                    return phoneTmpl.test(val)
                }
            },
            email: {
                required,
                email
            },
            telegram: {},
            site: {
                validSite:
                    val => /^((https?|ftp)\:\/\/)?([a-z0-9]{1})((\.[a-z0-9-])|([a-z0-9-]))*\.([a-z]{2,6})(\/?)$/.test(val)
            },
            skype: {},
            description: {
                required,
                minLength: minLength(50)
            },
            checky: {}
        },
    },
    methods: {

        changeTypePosition(event) {
            this.$v.currentService.checky.$touch()
            this.$store.dispatch('currentService/changeTypePosition', {
                name: event.target.parentElement.outerText,
                checked: event.target.checked,
            })
        },

        async saveChanges() {
            if (this.mode === 'insert') this.$v.$touch()
            if (this.ableToSave) {
                await this.$store.dispatch('currentService/sendServiceChanges')
                if (this.mode === 'view') {
                    this.$v.$reset()
                }
            }
        },

        cancelEdit() {
            if (this.mode !== 'view') {
                this.$store.dispatch('currentService/cancelEditMode')
                this.typesListKey += 1
                this.$v.$reset()
            }
        },
    },
}
</script>
