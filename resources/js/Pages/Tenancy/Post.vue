<template>
    <Head title="Post"/>
    <tenancy-authenticated>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>
                <div v-if="error" class="mb-4 font-medium text-sm text-red-600">
                    {{ error }}
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div class="flex justify-end">
                        <Link :href="route('post.create')" class="p-2 rounded bg-blue-500 text-white">Create</Link>
                    </div>
                    <div class="mt-5">
                        <table class="w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="border">#</th>
                                <th class="border">Title</th>
                                <th class="border">Author</th>
                                <th class="border">Description</th>
                                <th class="border">Status</th>
                                <th class="border">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(post, index) in posts" :key="post.id">
                                <td class="border p-2 text-center">{{ post.id }}</td>
                                <td class="border p-2">{{ post.title }}</td>
                                <td class="border p-2 w-40">{{ post.user.name }}</td>
                                <td class="border p-2">{{ post.description }}</td>
                                <td class="border p-2 w-20">
                                    <Switch v-model:checked="post.status" @input="updateStatus(post, index)"/>
                                </td>
                                <td class="border p-2 text-center">
                                    <Link :href="route('post.destroy', post.id)" method="delete" as="button"
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
    </tenancy-authenticated>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import TenancyAuthenticated from "@/Layouts/TenancyAuthenticated.vue";
import Switch from "@/Components/Switch.vue";

export default {
    name: "Post",
    components: {Switch, TenancyAuthenticated, Head, Link},
    props: {
        status: {
            type: String,
        },
        error: {
            type: String,
        },
        posts: {
            type: Array,
            default() {
                return []
            }
        }
    },
    methods: {
        updateStatus(post, index) {
            this.$inertia.patch(this.route('post-publish', post.id), {
                status: post.status,
            });
        }
    }
}
</script>

<style scoped>

</style>
