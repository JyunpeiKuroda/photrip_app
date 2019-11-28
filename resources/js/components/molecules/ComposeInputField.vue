<template>
    <div class="relative pt-4 px-4">
        <label :for="name" class="text-xs text-blue-400 font-bold absolute pt-2">{{ label }}</label>
        <input @input="updateValue" :value="value" :id="label" type="text" class="border-b pt-8 w-full focus:outline-none focus:border-blue-400" :placeholder="placeholder">
    </div>
</template>

<script>
export default {
    props: {
        name: String,
        label: String,
        placeholder: String,
        value: String
    },
    methods: {
        updateValue: function(e) {
            this.$emit("input", e.target.value);
        }
    }
}
</script>