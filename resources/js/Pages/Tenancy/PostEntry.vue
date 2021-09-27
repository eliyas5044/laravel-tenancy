<template>
    <Head title="Post Entry"/>

    <tenancy-authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post Entry
            </h2>
        </template>
        <div class="py-12">
            <div class="w-full sm:max-w-lg mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <BreezeValidationErrors class="mb-4"/>

                <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel for="title" value="Title"/>
                        <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required
                                     autofocus
                                     autocomplete="title"/>
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="description" value="Description"/>
                        <text-area id="description" type="text" class="mt-1 block w-full" v-model="form.description" required
                                     autocomplete="description"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                      :disabled="form.processing">
                            Create
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>
    </tenancy-authenticated>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import {Head, Link} from '@inertiajs/inertia-vue3';
import TextArea from "@/Components/TextArea.vue";
import TenancyAuthenticated from "@/Layouts/TenancyAuthenticated.vue";

export default {
    components: {
        TenancyAuthenticated,
        TextArea,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeCheckbox,
        BreezeValidationErrors,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                title: '',
                description: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('post.store'));
        }
    }
}
</script>
