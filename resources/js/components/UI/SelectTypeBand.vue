<template>
    <div class="type-switcher">
        <div class="shield" v-if="blocked">

        </div>
        <ul class="menu-ul">
            <li class="menu-li" v-for="(el,index) in types"
                @click="changeCurrentType(el.name)"
                v-bind:class="{'menu-li-active': (el.name===currentType&&!blocked)}"
                :disabled="blocked"
            >
                {{ el.name }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        currentType: String,
        types: Array,
        blocked: {
            type: Boolean,
            default: false,
        }
    },
    methods: {
        changeCurrentType: function (newType) {
            if (!this.blocked) this.$emit('setNewCurrentType', newType)
        }
    }
}

</script>
