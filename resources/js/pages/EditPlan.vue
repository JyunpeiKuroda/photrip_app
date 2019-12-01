<template>
    <div class="bg-gray-200 h-auto overflow-scroll">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg mb-30 h-auto overflow-scroll">

                <compose-i-f name="title" label="タイトル" placeholder="タイトルを入力してください" type="text"  v-model="form.guide.title"/>
                <compose-i-f name="days" label="期間" placeholder="期間を入力してください。例）12日" type="number"  v-model="form.guide.days"/>

                <!-- 概要フォーム -->
                <div id="overview" class="pt-20">
                    <div class="pl-4 flex justify-center">
                        <i class="fas fa-bars sm:text-xl lg:text-2xl text-center py-1 mr-2"></i><h1 class="sm:text-xl lg:text-2xl text-centerd">概要</h1>
                    </div>
                    <div class="pb-20"></div>
                    <div class="mb-5" v-for="(form, index) in form.overview" :key="index"> 
                        <div class="w-7/12 bg-white m-auto rounded-lg border shadow-xl p-6 h-auto">
                            <!-- クリアボタン -->
                            <div class="pb-3">
                                <a href="#" @click.prevent="deleteOverviewPanel(index)">
                                    <i class="fas fa-times float-right text-gray-500 hover:text-red-600"></i>
                                </a>
                            </div>

                            <div class="relative pt-4 px-4">
                                <label for="overview" class="text-xs text-blue-400 font-bold absolute pt-2">概要</label>
                                <input id="overview" v-model="form.overview" type="text" class="border-b pt-8 w-full focus:outline-none focus:border-blue-400" placeholder="例）持ち物など">
                            </div>
                            <div class="relative pt-4 px-4">
                                <label for="name" class="text-xs text-blue-400 font-bold absolute pt-2">詳細</label>
                                <textarea id="label" v-model="form.content" class="border-b pt-8 w-full focus:outline-none focus:border-blue-400" placeholder="例）充電コード"></textarea>
                            </div>  
                            <div class="pt-3 ml-8 clearfix">
                                <button @click="addOverviewPanel(form, index)" class="float-right bg-blue-500 px-3 py-2 rounded-full text-white border border-gray-600 hover:bg-blue-300">項目を追加</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 概要フォーム　end -->

                <!-- 計画フォーム -->
                <div id="overview" class="pt-20">
                    <div class="pl-4 flex justify-center">
                        <i class="fas fa-bars sm:text-xl lg:text-2xl text-center py-1 mr-2"></i><h1 class="sm:text-xl lg:text-2xl text-centerd">計画</h1>
                    </div>
                    <div class="pb-20"></div>
                    <div class="mb-5" v-for="(form, index) in form.place" :key="index">
                        <input id="id" v-model="form.id" type="hidden">

                        <div class="w-7/12 bg-white m-auto rounded-lg border shadow-xl p-6 h-auto">
                            <!-- クリアボタン -->
                            <div class="pb-3">
                                <a href="#" @click.prevent="deletePlacePanel(index)">
                                    <i class="fas fa-times float-right text-gray-500 hover:text-red-600"></i>
                                </a>
                            </div>

                            <div id="day">
                                <div class="flex">
                                    <div class="pt-2 px-4 relative">
                                        <label for="schedule" class="text-xs text-blue-400 font-bold absolute pt-2">日程</label>
                                        <input id="schedule" v-model="form.schedule" type="date" class="border-b pt-8 focus:outline-none focus:border-blue-400">
                                    </div>
                                    <div class="ml-2 pt-2 px-2 relative">
                                        <label for="time" class="text-xs text-blue-400 font-bold absolute pt-2">時間</label>
                                        <input id="time" v-model="form.time" type="time" class="border-b pt-8 focus:outline-none focus:border-blue-400">
                                    </div>
                                </div>
                            </div>

                            <div class="relative pt-4 px-4">
                                <label for="place" class="text-xs text-blue-400 font-bold absolute pt-2">概要</label>
                                <input id="place" v-model="form.place" type="text" class="border-b pt-8 w-full focus:outline-none focus:border-blue-400" placeholder="場所を入力してください">
                            </div>
                            <div class="relative pt-4 px-4">
                                <label for="name" class="text-xs text-blue-400 font-bold absolute pt-2">詳細</label>
                                <textarea id="label" v-model="form.detail" class="border-b pt-8 w-full" placeholder="詳細を入力してください"></textarea>
                            </div>  
                            <div class="pt-3 ml-8 clearfix">
                                <div class="inline">
                                    <label for="fileUpload" class="border border-gray-500 text-gray-500 py-2 px-2 rounded-lg hover:text-gray-700"> 
                                        <i class="fas fa-link mr-2"></i>写真を選択
                                    <input id="fileUpload" accept="image/jpeg, image/png" class="hidden border border-gray-600" @change="selectedFile(index, $event)" type="file">
                                    </label>
                                    <i class="fas fa-arrow-right mx-2"></i>
                                    <button class="border border-gray-500 text-gray-500 py-2 px-2 rounded-lg hover:text-gray-700" @click="uploadFile(index)">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i>写真をアップロード
                                    </button>
                                </div>
                                <button @click="addPlacePanel(form, index)" class="focus:outline-none float-right bg-blue-500 px-3 py-2 rounded-full text-white border border-gray-600 hover:bg-blue-300">項目を追加</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- 計画フォーム end-->

                <div class="pt-3 my-4 mx-4">
                    <button id="composeBtn" @click="composeGuide()" class="float-right bg-blue-500 px-3 py-2 rounded-full text-white border border-gray-600 hover:bg-blue-300">しおりを更新</button>
                </div>
            </div>
        </div>
        <loading-bar
        :isLoading="isLoading"
        ></loading-bar>
    </div>
</template>

<script>
import axios from 'axios';
import LbHeader from '../components/Header.vue';
import ComposeIF from '../components/molecules/ComposeInputField.vue';
import LoadingBar from '../components/LoadingBar.vue';

const NEW_CREATE_ID = 0

export default {
    components: {
        LbHeader,
        ComposeIF,
        LoadingBar
    },
    mounted () {
        this.initView()
    },
    computed: {
        checkQuery() {
            return this.$route.query.guide_id
        },
        isLoading() {
            return this.$store.state.loading.isLoading
        }
    },
    data() {
        return {
            form: {
                guide: {
                    title: '',
                    days: '',
                },
                overview: [
                    { overview: '', content: '' }
                ],
                place: [
                    { place: '', detail: '', schedule: '', time: '', file_path: null }
                ]
            },
        }
    },
    methods: {
        initView() {
            const endPoint = '/api/v1/edit/guides/' + this.checkQuery
            this.$store.commit('loading/setLoading', true)
            axios.get(endPoint)
                .then(res => {
                    this.form.guide.title = res.data.title
                    this.form.guide.days  = res.data.days
                    this.form.overview    = res.data.overviews
                    this.form.place       = res.data.places
                    console.log(res, 'response')
            })
            this.$store.commit('loading/setLoading', false)
        },
        // 概要フォーム
        addOverviewPanel(form, index) {
            const emptyPanel = {
                id: NEW_CREATE_ID
            }

            this.form.overview.splice(index + 1, 0, emptyPanel);
        },
        deleteOverviewPanel(index) {
            if (this.form.overview.length === 1) {
                alert('これ以上削除することはできません')
            } else {
                this.form.overview.splice(index, 1)
            }
        },
        // プランフォーム
        addPlacePanel(form, index) {
            const emptyPanel = {
                id: NEW_CREATE_ID
            }

            this.form.place.splice(index + 1, 0, emptyPanel);
            console.log(this.form.place)
        },
        deletePlacePanel(index) {
            if (this.form.place.length === 1) {
                alert('これ以上削除することはできません')
            } else {
                this.form.place.splice(index, 1)
            }
        },
        composeGuide() {
            const endPoint = '/api/v1/guides/' + this.checkQuery + '/edit'

            this.$store.commit('loading/setLoading', true)
            axios.put(endPoint, this.form)
                .then(res => {
                    console.log(res, '@@@@@@@@@@@')
                    this.$router.push('/photrip/home')
                })
            this.$store.commit('loading/setLoading', false)
        },
        // 画像選択＋アップロード
        selectedFile(index, e) {
            let files = e.target.files;
            this.$set(this.form.place[index], 'file_path', files[0])
        },
        // ファイルアップロード
        async uploadFile(index) {
            var formData = new FormData()
            console.log(index)

            formData.append('s3', this.form.place[index].file_path)

            this.$store.commit('loading/setLoading', true)
            await axios.post('/api/v1/upload/photos', formData, {
                headers: {
                     'Content-Type': 'multipart/form-data'
                }
            })
            .then(res => {
                this.form.place[index].file_path = res.data
                console.log(res.data, 'response')
            })
            .catch(error => {
                console.warn(error, 'error')
            })
            this.$store.commit('loading/setLoading', false)
        }
    }
}
</script>

