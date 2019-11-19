<template>
    <div class="bg-gray-200">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg h-screen mb-30">
                <div class="pb-10"></div>

                <div id="bookmarkTitle" class="h-18 w-8/12 shadow-lg border-solid border-2 border-gray-600 m-auto py-4">
                    <h1 class="text-center text-2xl text-gray-600">タイトルでございまする</h1>
                <!-- <h1>{{ title }}</h1> -->
                </div>
                <div class="pb-20"></div>

                <div id="Overview" class="pl-4 flex justify-center">
                    <i class="fas fa-bars text-3xl text-center py-1 mr-2"></i><h1 class="text-3xl text-centerd">概要</h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LbHeader from '../components/Header.vue';
export default {
    components: {
        LbHeader
    },
}
</script>