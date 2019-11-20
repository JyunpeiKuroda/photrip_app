<template>
    <div class="bg-gray-200 h-auto overflow-scroll">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg mb-30 h-auto overflow-scroll">

                <compose-i-f name="title" label="タイトル" placeholder="タイトルを入力してください" v-model="title"/>
                <compose-i-f name="days" label="期間" placeholder="期間を入力してください。例）12日" v-model="days"/>

                <!-- 概要フォーム -->
                <div id="overview" class="pt-20">
                    <div class="pl-4 flex justify-center">
                        <i class="fas fa-bars sm:text-xl lg:text-2xl text-center py-1 mr-2"></i><h1 class="sm:text-xl lg:text-2xl text-centerd">概要</h1>
                    </div>
                    <div class="pb-20"></div>
                    <div class="">
                        <overview-panel/>
                    </div>
                </div>

                <!-- 計画フォーム -->
                <div id="overview" class="pt-20">
                    <div class="pl-4 flex justify-center">
                        <i class="fas fa-bars sm:text-xl lg:text-2xl text-center py-1 mr-2"></i><h1 class="sm:text-xl lg:text-2xl text-centerd">計画</h1>
                    </div>
                    <div class="pb-20"></div>
                    <div class="">
                        <place-detail-panel
                        :place="overviewForm.place"
                        :content="overviewForm.content"
                        v-model="overviewForm"
                        @addPlacePanel="addPlacePanel()"
                        ></place-detail-panel>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LbHeader from '../components/Header.vue';
import ComposeIF from '../components/molecules/ComposeInputField.vue';
import OverviewPanel from '../components/organisms/OverviewPanel.vue';
import PlaceDetailPanel from '../components/organisms/PlaceDetailPanel.vue';


export default {
    components: {
        LbHeader,
        ComposeIF,
        OverviewPanel,
        PlaceDetailPanel
    },
    mounted () {
        // 初期データの取得
        this.title = '京都旅行'
        this.days = '12日'
        console.log(this.title);
    },
    data() {
        return {
            title: '',
            days: '',
            overviewForm: [
                { place: '', content: '' }
            ]
        }
    },
    methods: {
        addPlacePanel() {
            this.overviewForm
            console.log(this.overviewForm, 'overviewForm')
        }
    }

}
</script>

