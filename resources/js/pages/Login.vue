<template>
    <div class="">
        <div class="bg-blue-500 h-full mx-auto flex justify-center items-center">
            <div class="w-96 bg-white rounded-lg shadow-xl p-6">
                <h1 class="text-black text-3xl" id="loginTitle">めもりあ</h1>

                <div class="mt-10 text-xl align-middle" id="loginContent">
                    <p>旅が終わればすぐに捨てるしおり。<br>
                    <strong>めもりあ</strong>ではしおりに写真を紐付けることで<br>
                    思い出の記録として後から楽しむこともできます。</p>
                </div>
                <!-- この箇所は認証の実装が終われば解放（現状Twiiterのみ） -->
                    <!-- <div class="">
                        <div class="">
                            <input id="email" type="email" placeholder="メールアドレス" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="email" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            <input id="password" type="password" placeholder="パスワード" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="password" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="bg-blue-500 rounded-lg w-64 text-white font-hairline">ログイン</button>
                    </div> -->
                    <!-- <p class="text-gray-400 text font-hairline" id="loginSelectOr">or</p> -->
                    <div class="social-auth-links bg-blue-400 rounded-lg w-64 h-12 shadow-lg" id="social-auth-wrap">
                        <div class="" id="social-auth-title">
                            <i class="fab fa-twitter text-white"></i>
                            <a href="#" class="text-white" id="social-auth-title-link">Twitterでログイン</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
}
</script>

<style scoped>
::placeholder {
    font-size: 8px;
}

#loginContent {
    text-align: center;
}

#loginTitle {
    text-align: center;    
}

#social-auth-wrap {
    margin: auto;
    margin-top: 50px;
}

#social-auth-title {
    margin: 0 auto;
    display:block;
    width: 60%;
    line-height: 45px;
}

#social-auth-title-link {
    text-decoration: none;
}
</style>