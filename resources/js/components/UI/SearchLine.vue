<template>

    <div class="search-line-wrapper">
        <!--            <img class="menu-search-img" src="img/search-icon.png">-->
        <span class="search-icon">
                <i class="fa fa-search green-colored" aria-hidden="true"></i>
            </span>

        <label for="search-input" class="search-labels">
            <input class="search-input"
                   placeholder="Поиск по названию"
                   id="search-input"
                   name="search-input"
                   v-model="sString"
                   @input="$emit('update:searchStr',sString)"
            >
        </label>
    </div>


    <!--    <div class="menu-search">-->
    <!--        <img class="menu-search-img" src="img/search-icon.png">-->
    <!--&lt;!&ndash;        <i class="fa fa-search" aria-hidden="true"></i>&ndash;&gt;-->
    <!--        <label class="menu-search-label" for="menu-search-input-name">-->
    <!--            <input class="menu-search-input"-->
    <!--                   placeholder="Поиск по названию"-->
    <!--                   id="menu-search-input-name"-->
    <!--                   name="menu-search-input-name"-->
    <!--                   v-model="sString"-->
    <!--                   @input="$emit('update:searchStr',sString)"-->
    <!--            >-->
    <!--        </label>-->
    <!--    </div>-->

</template>


<script>

export default {
    props: ['searchStr'],
    data: () => {
        return {
            sString: '',
        }
    }
}
</script>

<style>

/*.green-colored {*/
/*    color: green;*/
/*}*/

.search-line-wrapper {
    /*height: 160px;*/
    background-color: #fff;
    border-radius: 15px;
    padding: 10px 15px 5px 15px;
    display: flex;
    flex-wrap: nowrap;
}

.search-icon {
    padding: 0 5px 0 0;
}

.search-labels {
    width: calc(100% - 13px)
}

.search-input {
    background-color: transparent;
    border: none;
    width: calc(100% - 1px)
}

.search-input:focus {
    border: 0;
    outline: 0;
}

</style>
