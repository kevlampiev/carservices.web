<template>

    <div class="menu-search">
        <img class="menu-search-img" src="img/search-icon.png">
        <label class="menu-search-label" for="menu-search-input-name">
            <input class="menu-search-input"
                   placeholder="Поиск по названию"
                   id="menu-search-input-name"
                   name="menu-search-input-name"
                   v-model="sString"
                   @input="$emit('update:searchStr',sString)"
            >
        </label>
    </div>

<!--    <div class="input-group">-->

<!--        <input-->
<!--            class="form-control py-2 border-right-0 border-left-0 border-top-0 bg-transparent"-->
<!--            type="search" placeholder="Поиск по названию"-->
<!--            id="example-search-input"-->
<!--            v-model="sString"-->
<!--            @input="$emit('update:searchStr',sString)"-->
<!--        >-->
<!--        <span class="input-group-append">-->
<!--                                      <div-->
<!--                                          class="input-group-text bg-transparent border-right-0 border-left-0 border-top-0">-->
<!--                                          <i class="fa fa-search"></i>-->
<!--                                      </div>-->
<!--                                </span>-->
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
.city-list-container {
    columns: 150px 3;
    column-gap: 30px;
    column-rule: 1px solid #ccc;
    overflow: scroll;
}

.city-list-container > ul {
    padding: 10px 10px 10px 20px;
    height: 800px;

}

.city-list-container > ul > li {
    list-style-type: none;
}
</style>
