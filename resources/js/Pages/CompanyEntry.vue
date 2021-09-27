<template>
    <Head title="Company Entry"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Company Entry
            </h2>
        </template>
        <div class="py-12">
            <div class="w-full sm:max-w-lg mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <BreezeValidationErrors class="mb-4"/>

                <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel for="name" value="Name"/>
                        <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                     autofocus
                                     autocomplete="name"/>
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="subdomain" value="Subdomain"/>
                        <BreezeInput id="subdomain" type="text" class="mt-1 block w-full" v-model="form.subdomain" required
                                     autocomplete="subdomain"/>
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <BreezeCheckbox name="status" v-model:checked="form.status" />
                            <span class="ml-2 text-sm text-gray-600">Status</span>
                        </label>
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
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import {Head, Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeCheckbox,
        BreezeValidationErrors,
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                subdomain: '',
                status: true,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('company.store'));
        }
    }
}
</script>
