<template>
    <div>
        <ul class="flex list-reset border border-grey-light rounded w-auto font-sans">
            <li v-if="!isFirstPage">
                <router-link
                 class="block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2" 
                 :to="`/?page=${currentPage - 1}`"
                 >&laquo; 戻る
                 </router-link>
            </li>
            <li>
                <router-link
                 class="block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2" 
                 :to="`/?page=${currentPage + 1}`"
                 >
                 </router-link>
            </li>
            <li v-if="!isLastPage !== 1">
                <router-link
                 class="block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2" 
                 :to="`/?page=${currentPage + 1}`"
                 >進む &raquo;
                 </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
  props: {
    currentPage: Number,
    lastPage: Number,
  },
  computed: {
    isFirstPage () {
      return this.currentPage === 1
    },
    isLastPage () {
      return this.currentPage === this.lastPage
    }
  }
}
</script>