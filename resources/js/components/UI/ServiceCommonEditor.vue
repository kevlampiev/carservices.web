<template>
    <div class="services-info-editor-el">
        <div class="services-info-layout-1">
            <div class="services-info-field">
                <div class="services-info-field-group">
                    <label :for="'services-info-field-input-company-name'"
                           class="services-info-field-label">Наименование</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-company-name"
                           v-model="currentService.name"
                           @blur="$v.currentService.name.$touch()"
                           :class="{'invalid-data':
                                    ($v.currentService.name.$dirty &&((!$v.currentService.name.required)|| (!$v.currentService.name.minLength)))
                           }"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.currentService.name.$dirty && !$v.currentService.name.required">
                    Укажите Название сервиса
                </small>
                <small class="error-notificator"
                       v-if="$v.currentService.name.$dirty && !$v.currentService.name.minLength">
                    В названии сервиса должно быть хотя бы 10 символов
                </small>

                <div class="services-info-field-group">
                    <label for="services-info-field-input-city" class="services-info-field-label">Город:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-city"
                           v-model="currentService.city"
                           @blur="$v.currentService.city.$touch()"
                           :class="{'invalid-data':
                                    ($v.currentService.city.$dirty &&((!$v.currentService.city.required)|| (!$v.currentService.city.minLength)))
                           }"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.currentService.city.$dirty && !$v.currentService.city.required">
                    Укажите название населенного пункта
                </small>
                <small class="error-notificator"
                       v-if="$v.currentService.city.$dirty && !$v.currentService.city.minLength">
                    В названии населенного пункта должно быть хотя бы 2 символа
                </small>


                <div class="services-info-field-group">
                    <label for="services-info-field-input-street" class="services-info-field-label">Улица, дом /
                        строение:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-street"
                           v-model="currentService.address"
                           @blur="$v.currentService.address.$touch()"
                           :class="{'invalid-data':
                                    ($v.currentService.address.$dirty &&((!$v.currentService.address.required)|| (!$v.currentService.address.minLength)))
                           }"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.currentService.address.$dirty && !$v.currentService.address.required">
                    Укажите адрес (улица, дом)
                </small>
                <small class="error-notificator"
                       v-if="$v.currentService.address.$dirty && !$v.currentService.address.minLength">
                    минимальная длина адреса - 25 символов
                </small>

                <div class="services-info-field-group">
                    <label for="services-info-field-input-phone" class="services-info-field-label">Телефон:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-phone"
                           v-model="currentService.phone"
                           @blur="$v.currentService.phone.$touch()"
                           :class="{'invalid-data': ($v.currentService.phone.$dirty && !$v.currentService.phone.validPhone)}"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.currentService.phone.$dirty && !$v.currentService.phone.validPhone">
                    Укажите корректный номер телефона
                </small>


                <div class="services-info-field-group">
                    <label for="services-info-field-input-email" class="services-info-field-label">E-mail:</label>
                    <input type="text"
                           class="services-info-field-input"
                           id="services-info-field-input-email"
                           v-model="currentService.email"
                           @blur="$v.currentService.email.$touch()"
                           :class="{'invalid-data': ($v.currentService.email.$dirty && !$v.currentService.email.email)}"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.currentService.email.$dirty && !$v.currentService.email.email">
                    Укажите корректный адрес электронной почты
                </small>



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
                           @blur="$v.currentService.site.$touch()"
                           :class="{'invalid-data': ($v.currentService.site.$dirty && !$v.currentService.site.validSite)}"
                    >
                </div>
                <small class="error-notificator"
                       v-if="$v.currentService.site.$dirty && !$v.currentService.site.validSite">
                    Укажите корректный URL
                </small>


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
                    Напишите краткое описание Вашего сервиса длиной не менее 50 символов
                </small>
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


        <div class="services-info-button-savechanges"
            :class="{'disabled-btn': !ableToSave}"
        >Сохранить
            изменения
        </div>

        <div class="services-info-button-cancel"
             :class="{'disabled-btn': mode==='view'}">
            Отмена
        </div>

    </div>
</template>


<script>
import {required, minLength, email, sameAs} from "vuelidate/lib/validators"
import currentService from "../../store/modules/currentService";
export default {

    computed: {
        currentService() {
            return this.$store.state.currentService.commonInfo
        },
        types() {
            let result=[]
            const sTypes=this.$store.state.currentService.types
            if (!sTypes) return [] //Это если еще ене прогрузился элемент
            this.$store.state.types.forEach(
                (el,index)=>{
                    if (index>0) {
                        el.inServiceList= (sTypes.findIndex(item => item.name===el.name)>-1)
                        result.push(el)

                    }
                }
            )
            return result
        },
        mode() { //в каком режиме находится компонент : редактирование, чтение или вставка
            if (this.currentService.id>-1) {
                return this.$v.currentService.$anyDirty ? "edit" : "view"
            } else {
                return 'insert'
            }
        },

        //Если true, то можно отжимать кнопку "Сохранить"
        ableToSave() {
            return this.$v.currentService.$anyDirty&&!this.$v.currentService.$anyError
        }
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
            telegram: {
            },
            site: {
                validSite:
                    val=>/^((https?|ftp)\:\/\/)?([a-z0-9]{1})((\.[a-z0-9-])|([a-z0-9-]))*\.([a-z]{2,6})(\/?)$/.test(val)
            },
            skype: {},
            description: {
                required,
                minLength: minLength(50)
            }
        },
    },
}
</script>
