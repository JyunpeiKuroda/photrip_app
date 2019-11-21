<template>
    <div class="bg-blue-300 h-full w-full pt-8">
        <div class="border-4 border-red-500 rounded-lg py-4 px-4 w-2/4 mx-auto mt-64 mb-12 bg-white">
            <p class="font-extrabold text-5xl text-center">404 this is not web page!</p>
        </div>
        <div class="m-auto bg-gray-100 text-center py-4 border-4 border-gray-300 rounded-lg w-1/4 hover:bg-gray-400 hover:text-white">
            <button @click="$router.push({ path: '/photrip/home' })" class="text-lg font-semibold">メイン画面へ</button>
            <!-- <button @click="">ログイン画面へ</button> -->
        </div>
    </div>
</template>