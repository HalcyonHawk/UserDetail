<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia'


</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link :href="route('user.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                </Link>

                <Link :href="route('user.trashed')">
                    <SecondaryButton>
                        Deleted Users
                    </SecondaryButton>
                </Link>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900" v-if="users">
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                            </tr>

                            <tr v-for="user in users" :key="user.id">
                                <td>{{ user.firstname }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type }}</td>
                                <td>
                                    <Link :href="route('user.show', {user: user})">
                                        <PrimaryButton>
                                            View
                                        </PrimaryButton>
                                    </Link>
                                </td>
                                <td>
                                    <Link :href="route('user.edit', {user: user})">
                                        <PrimaryButton>
                                            Edit
                                        </PrimaryButton>
                                    </Link>
                                </td>
                                <td>
                                    <DangerButton @click="deleteUser(user)">
                                        Delete
                                    </DangerButton>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="p-6 text-gray-900" v-else>
                        <p>No users found</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">

        </div>
    </AuthenticatedLayout>
</template>


<script>
export default {
    components: {
        PrimaryButton,
        SecondaryButton,
        DangerButton
    },
    props: {
        users: {
            type: Array,
            required: true
        }
    },
    methods: {
        deleteUser(user) {
            if (confirm('Are you sure?')) {
                //this.$inertia.delete(user.delete_url);
                Inertia.post(user.destroy_url, {
                    _method: 'delete'
                },
                {
                    onError: error => {
                        console.error(error)
                    },
                    onSuccess: page => {
                        console.log(page)
                    },
                    onComplete: () => {
                        console.log("")

                    }
                })
            }
        },
    },
};
</script>
