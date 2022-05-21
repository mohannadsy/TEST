<template>

</template>

<script>
    export default {
        name: "LanguageSwitcher",
        data:() =>({languages:['en','ar']}),
        // template:<ul><li v-for="lang in languages" :key="lang" @click="ChangeLang(lang)">{{lang}}</li></ul>,
        methods:{
        ChangeLang(lang){
            $this.$i18n.local = lang
        }
    }
    }
</script>

<style scoped>

</style>


