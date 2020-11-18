<template>
    <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
            <a class="nav-link" href="#" @click="changeCurrentType('*')"
               v-bind:class="{active: curType==='*'}">Все </a>
        </li>
        <li class="nav-item" v-for="(el,index) in types">
            <a class="nav-link" href="#" @click="changeCurrentType(el.name)"
               v-bind:class="{active: el.name===curType}"
            >{{ el.name }}</a>
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
