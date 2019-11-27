<template>
    <div>
        <div id="overview" class="px-16 py-10">
            <div class="">
                <h1 class="border-l-4 border-blue-400 text-xl pl-2">{{ overviewTitle }}</h1>
            </div>
            <div class="w-10/12 bg-gray-200 h-auto mt-4 rounded-lg py-4 px-4">
                <p class="text-gray-600">{{ overviewContent }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        overviewTitle: String,
        overviewContent: String
    },
}
</script>