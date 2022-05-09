<template>

    <div v-for="post in posts" :key='post.id'>
        {{post.title}}
    </div>

</template>

<script>
export default {
    props : {
        posts : Object
    }
}
</script>