<template>
    <div class="block flex">
        <ul class="list-reset border border-grey-light rounded w-auto font-sans mx-auto">
            <li v-if="!isFirstPage">
                <p
                 class="block hover:bg-blue text-blue border-r border-grey-light px-3 py-2" 
                 @click="$emit('backPage')"
                 >&laquo; 戻る
                 </p>
            </li>
            <li v-if="!isLastPage">
                <p
                 class="block hover:bg-blue text-blue border-r border-grey-light px-3 py-2" 
                 @click="$emit('nextPage')"
                 >進む &raquo;
                 </p>
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