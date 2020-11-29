<template>
    <div class="company-about">
        <img class="company-about-img" :src="description.img_link" alt="">
        <div class="company-about-info-wrapper">
            <h2 class="company-about-info-name">{{ description.name }}</h2>
            <div class="company-about-info-line">
                <i class="fa fa-map-marker green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-address">{{ description.city }}, {{ description.address }}</div>
            </div>
            <div class="company-about-info-line">
                <i class="fa fa-clock-o green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-worktime">Открыто:
                    <span class="company-about-info-line-worktime-place">пн – пт 9:00–19:00</span>
                </div>
            </div>
            <div class="company-about-info-line" v-if="description.phone">
                <i class="fa fa-phone green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-phone">{{ description.phone }}</div>
            </div>

            <div class="company-about-info-line" v-if="description.telegram">
                <i class="fa fa-telegram green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-phone">{{ description.telegram }}</div>
            </div>

            <div class="company-about-info-line" v-if="description.skype">
                <i class="fa fa-skype green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-phone">{{ description.skype }}</div>
            </div>

            <div class="company-about-info-line" v-if="description.email">
                <i class="fa fa-envelope-o green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-phone">{{ description.email }}</div>
            </div>

            <div class="company-about-info-line" v-if="description.site">
                <i class="fa fa-internet-explorer green-colored" aria-hidden="true"></i>
                <div class="company-about-info-line-phone">{{ description.site }}</div>
            </div>


        </div>
        <div class="company-about-text">
            <h2 class="company-about-text-title">Описание</h2>
            <span class="company-about-text-inner">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia
                            maxime commodi, qui dignissimos repellat ut sapiente voluptatibus
                            architecto voluptatem iure impedit laudantium vel et similique
                            perferendis porro. Adipisci, fuga fugit.
                        </span>
        </div>
    </div>
</template>


<script>
export default {
    props: ['description'],
}
</script>
