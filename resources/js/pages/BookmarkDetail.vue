<template>
    <div class="bg-gray-200 h-auto overflow-scroll">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg mb-30 h-auto overflow-scroll">
                <div class="pb-10"></div>

                <div id="bookmarkTitle" class="h-18 w-8/12 shadow-lg border-solid border-2 border-gray-600 m-auto py-4">
                    <h1 class="text-center text-2xl text-gray-600">{{ bookmarkTitle }}</h1>
                </div>
                <div class="pb-20"></div>

                <!-- 概要 -->
                <div id="overview" class="">
                    <div class="pl-4 flex justify-center">
                        <i class="fas fa-bars sm:text-xl lg:text-2xl text-center py-1 mr-2"></i><h1 class="sm:text-xl lg:text-2xl text-centerd">概要</h1>
                    </div>
                    <div class="pb-20"></div>
                    <div class="">
                        <over-view
                        v-for="(datum, index) in data"
                        :key=index
                        :overviewTitle="datum.overviewTitle"
                        :overviewContent="datum.overviewContent"
                        ></over-view>
                    </div>
                </div>

                <!-- 計画 -->
                <div id="plan" class="pt-20">
                    <div class="pl-4 flex justify-center">
                        <i class="fas fa-location-arrow sm:text-xl lg:text-2xl text-center py-1 mr-2"></i><h1 class="sm:text-xl lg:text-2xl text-centerd">計画</h1>
                    </div>
                    <div class="pb-10"></div>
                    <plan
                    v-for="(datum, index) in planData"
                    :key="index"
                    :day="datum.day"
                    :place="datum.place"
                    :placeDetail="datum.placeDetail"
                    :endDeclear="datum.endDeclear"
                    :imgLink="datum.imgLink"
                    ></plan>
                </div> 

                <!-- 編集ボタン -->
                <div class="w-32 p-4 float-right">
                    <button class="text-gray-700 text-center bg-gray-400 p-2 rounded-full">編集する</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LbHeader from '../components/Header.vue';
import OverView from '../components/molecules/BMOverview.vue';
import Plan from '../components/molecules/BMPlan.vue';

export default {
    components: {
        LbHeader,
        OverView,
        Plan
    },
    data() {
        return {
            data: [
                { overviewTitle: '持ち物', overviewContent: '・充電器'},
                { overviewTitle: '持ち物', overviewContent: 'あちこ'},
            ],
            planData: [
                { day: '1', place: '東京駅', placeDetail: '', endDeclear: false, imgLink: true },
                { day: '0', place: '東京駅', placeDetail: '', endDeclear: false, imgLink: false },
                { day: '0', place: '東京駅', placeDetail: '', endDeclear: false, imgLink: false },
                { day: '0', place: '東京駅', placeDetail: '', endDeclear: false, imgLink: false },
                { day: '2', place: '東京駅', placeDetail: '', endDeclear: false, imgLink: false},
                { day: '0', place: '東京駅', placeDetail: '', endDeclear: true, imgLink: false },
            ],
            bookmarkTitle: '京都旅行'
        }
    }
}
</script>

<style scoped>
#mainContent {
    padding-bottom: 100px;
}
</style>