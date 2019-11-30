<template>
    <div>
        <div id="overview" class="">
            <div id="planline" class="px-5">
                <h3 class="subtitle font-extrabold" v-if="section !== 0">{{ section }}日目</h3>
                <dl class="schedule-item">
                    <dt></dt>
                    <dd class="content">
                        <div class="block">                            
                            <a :href="imgLink" v-if="imgLink !== null">{{ place }} ({{ time }})<i class="far fa-images pl-2"></i></a>
                            <p v-else>{{ place }} ({{ time }})</p>
                        </div>
                        <div class="bg-gray-200 rounded-lg py-3 px-2 my-3" v-if="placeDetail">
                            <p class="text-gray-600">{{ placeDetail }}</p>
                        </div>
                    </dd>
                </dl>
                <p class="subtitle text-xs font-semibold endtitle" v-if="endDeclear">お疲れ！</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        section: Number,
        place: String,
        placeDetail: String,
        endDeclear: Boolean,
        imgLink: String,
        time: String
    }
}
</script>

<style scoped>
.subtitle {
    padding-top: 20px;
    background-color: #fff;
    color: #21252B;
    margin-top: 0;
    margin-bottom: 0;
    width: 64px;
    height: 64px;
    border: 4px solid #21252B;
    border-radius: 50%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    font-size: 14px;
    text-align: center;
    margin-left: 25px;
    font-family: 'Roboto Condensed', sans-serif;
    line-height: 16px;
    letter-spacing: 1px;
    text-indent: 1px;
    break-inside: avoid;
    padding-bottom: 1px;
}

.schedule-item > .content {
    min-height: 3em;
    position: relative;
    margin-left: 55px;
    padding: 6px 0 .2rem 12px;
    border-left: 4px solid #13b1f1;
    z-index: 0;
}

.schedule-item > .content::before {
    content: '';
    display: block;
    width: 16px;
    height: 16px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border: 4px solid #21252b;
    border-radius: 50%;
    position: absolute;
    left: -10px;
    top: 8px;
    background-color: #fff;
}

.endtitle {
    font-size: 12px;
    padding-left:3px;
}
</style>