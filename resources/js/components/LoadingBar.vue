<template>
    <section>
        <b-loading is-full-page :active.sync="isLoading"></b-loading>
    </section>
</template>

<script>
    export default {
        props: {
            isLoading: Boolean
        }
    }
</script>