<template>
    <ul class="menu-ul">
        <li class="menu-li" v-for="(el,index) in types"
            @click="changeCurrentType(el.name)"
            v-bind:class="{'menu-li-active': el.name===currentType}">
            {{ el.name }}
        </li>
    </ul>
</template>

<script>
export default {
    props: ['currentType', 'types'],
    methods: {
        changeCurrentType: function (newType) {
            this.$emit('setNewCurrentType', newType)
        }
    }
}

</script>
