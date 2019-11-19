<template>
    <div>
        <div id="overview" class="px-16 pm-10">
            <div id="planline" class="mt-10">
                <h3 class="subtitle font-extrabold">{{ day }}日目</h3>
                <dl class="schedule-item">
                    <dt></dt>
                    <dd class="content">
                        <div class="block">{{ place }}</div>
                        <div class="bg-gray-200 rounded-lg py-3 px-2 my-3 sm:overflow-x-scrooll" v-if="placeDetail.trim()">
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
        day: String,
        place: String,
        placeDetail: String,
        endDeclear: Boolean
    }
}
</script>

<style scoped>
  #overview {
      margin-bottom: 100px;
  }

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