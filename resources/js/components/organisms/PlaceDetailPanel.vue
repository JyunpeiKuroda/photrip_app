<template>
    <div>
        <div class="w-7/12 bg-white m-auto rounded-lg border shadow-xl p-6 h-auto">
            <!-- クリアボタン -->
            <div class="pb-3">
                <a href="#">
                    <i class="fas fa-times float-right text-gray-500 hover:text-red-600"></i>
                </a>
            </div>
            <!--  -->
            <compose-i-f name="place" label="場所" placeholder="場所を入力してください" v-model="place"/>
            <compose-content name="content" label="詳細" placeholder="詳細を入力してください" v-model="content"/>
            <div class="pt-3 ml-8 clearfix">
                <button @click="$emit('addPlacePanel')" class="float-right bg-blue-500 px-3 py-2 rounded-full text-white border border-gray-600 hover:bg-blue-300">項目を追加</button>
            </div>
        </div>
    </div>
</template>

<script>
import ComposeIF from '../molecules/ComposeInputField.vue';
import ComposeContent from '../molecules/BMoverviewTextarea.vue';

export default {
    components: {
        ComposeIF,
        ComposeContent
    },
    props: {
        place: String,
        content: String
    },
    methods: {
        
    }
}
</script>