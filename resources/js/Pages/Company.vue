<template>
    <Head title="Company"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Companies
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div class="flex justify-end">
                        <Link :href="route('company.create')" class="p-2 rounded bg-blue-500 text-white">Create</Link>
                    </div>
                    <div class="mt-5">
                        <table class="w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Name</th>
                                <th class="border">UUID</th>
                                <th class="border">Subdomain</th>
                                <th class="border">Status</th>
                                <th class="border">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="company in companies" :key="company.id">
                                <td class="border p-2 text-center">{{ company.id }}</td>
                                <td class="border p-2">{{ company.name }}</td>
                                <td class="border p-2">{{ company.uuid }}</td>
                                <td class="border p-2">{{ company.subdomain }}</td>
                                <td class="border p-2">{{ company.status ? 'Active' : 'Inactive' }}</td>
                                <td class="border p-2 text-center">
                                    <!--                                    <Link :href="'/tenancy/'+company.subdomain" replace target="_blank" class="p-2 mr-2 rounded bg-blue-500 text-white">-->
                                    <!--                                        Visit-->
                                    <!--                                    </Link>-->
                                    <button class="p-2 mr-2 rounded bg-blue-500 text-white" type="button"
                                            @click="visitCompany(company)">
                                        Visit
                                    </button>
                                    <Link :href="route('company.destroy', company.id)" method="delete" as="button"
                                          type="button" class="p-2 rounded bg-pink-600 text-white">Delete
                                    </Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

export default {
    name: "Company",
    components: {Head, Link, BreezeAuthenticatedLayout},
    props: {
        status: {
            type: String,
        },
        companies: {
            type: Array,
            default() {
                return []
            }
        }
    },
    methods: {
        visitCompany(company) {
            this.$inertia.post(this.route('logout'), {
                tenancy: company.subdomain,
            }, {
                onFinish: () => window.location.reload(true)
            });
            // this.$inertia.get(`/tenancy/${company.subdomain}`, {}, {
            //     onStart: () => ) ,
            //     onSuccess: () => window.location.reload(true)
            // });
        }
    }
}
</script>

<style scoped>

</style>
