<template>
    <label class="w-14 h-8 flex items-center bg-gray-300 rounded-full p-1 duration-300 cursor-pointer"
           :class="{ 'bg-green-500': checked }">
        <input
            class="sr-only"
            type="checkbox"
            :checked="checked"
            @input="$emit('update:checked', $event.target.checked)"
        />
        <span class="bg-white w-6 h-6 rounded-full shadow-md transform duration-300"
              :class="{ 'translate-x-6': checked }"></span>
    </label>
</template>

<script>
export default {
    name: 'Switch',
    emits: ['update:checked'],
    props: {
        checked: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
