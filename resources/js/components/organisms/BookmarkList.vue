<template>
    <div>
        <div id="Bookmark_list_wrap" class="h-20 px-4 hover:bg-gray-100 py-5">
            <router-link :to="{ path: '/photrip/guide/detail', query: { guide_id: `${ guideId }`}}">
            <div id="list_userinfo" class="no-underline bg-blue-200 w-10 h-10 inline-block rounded-full">
                <img src="#" alt="">
            </div>
            <div id="bookmark_list_detail" class="inline-block ml-2">
                <p class="font-medium">{{ title }} (日数：{{ days }})</p>
                <p class="text-xs text-gray-600">dear {{ username }}</p>
            </div>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log(this.guideId)
    },
    props: {
        title: String,
        days: String,
        username: String,
        guideId: String
    }
}
</script>

/photrip/bookmark/detail