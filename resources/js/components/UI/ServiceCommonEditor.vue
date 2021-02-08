<template>
    <div class="services-info-editor-el">
        <div class="services-info-layout-1">
            <div class="services-info-field">
                <div class="services-info-field-group">
                    <label for="services-info-field-input-company-name"
                           class="services-info-field-label">Наименование</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-company-name">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-city" class="services-info-field-label">Город:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-city">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-street" class="services-info-field-label">Улица, дом /
                        строение:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-street">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-phone" class="services-info-field-label">Телефон:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-phone">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-email" class="services-info-field-label">E-mail:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-email">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-telegram" class="services-info-field-label">Telegram:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-telegram">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-skype" class="services-info-field-label">Skype:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-skype">
                </div>
                <div class="services-info-field-group">
                    <label for="services-info-field-input-website" class="services-info-field-label">Website:</label>
                    <input type="text" class="services-info-field-input" id="services-info-field-input-website">
                </div>
                <label for="services-info-field-textarea" class="services-info-field-textarea-label">Общее
                    описание:</label>
                <textarea class="services-info-field-textarea" id="services-info-field-textarea"></textarea>
            </div>
        </div>
        <div class="services-info-layout-2">
            <div class="services-info-types-wrapper">
                <h3 class="services-info-types-title">Оказываемые услуги</h3>
                <form class="services-info-types-list-form">
                    <div class="services-info-types-list-form-group">
                        <label for="services-info-types-list-checkbox-carwash">
                            <input type="checkbox" class="services-info-types-list-checkbox"
                                   id="services-info-types-list-checkbox-carwash">
                            <span></span>
                            Автомойка
                        </label>
                    </div>
                    <div class="services-info-types-list-form-group">
                        <label for="services-info-types-list-checkbox-tirefitting">
                            <input type="checkbox" class="services-info-types-list-checkbox"
                                   id="services-info-types-list-checkbox-tirefitting">
                            <span></span>
                            Шиномонтаж
                        </label>
                    </div>
                    <div class="services-info-types-list-form-group">
                        <label for="services-info-types-list-checkbox-autoservice">
                            <input type="checkbox" class="services-info-types-list-checkbox"
                                   id="services-info-types-list-checkbox-autoservice">
                            <span></span>
                            Автосервис
                        </label>
                    </div>
                    <div class="services-info-types-list-form-group">
                        <label for="services-info-types-list-checkbox-tirestorage">
                            <input type="checkbox" class="services-info-types-list-checkbox"
                                   id="services-info-types-list-checkbox-tirestorage">
                            <span></span>
                            Хранение шин
                        </label>
                    </div>
                </form>
            </div>
            <div class="services-info-photo-wrapper">
                <h3 class="services-info-photo-title">Фотография</h3>
                <div class="services-info-photo-field">
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
}
</script>
