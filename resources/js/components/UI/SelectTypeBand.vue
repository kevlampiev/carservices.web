<template>
    <ul class="menu-ul">
        <li class="menu-li" v-for="(el,index) in types"
            @click="changeCurrentType(el.name)"
            v-bind:class="{'menu-li-active': el.name===curType}">
            {{ el.name }}
        </li>
    </ul>
</template>

<script>
export default {
    props: ['currentType', 'types'],
    data: () => {
        return {
            curType: '*'
        }
    },
    methods: {
        changeCurrentType: function (newType) {
            this.curType = newType
            this.$emit('setNewCurrentType', newType)
        }
    }
}

</script>
