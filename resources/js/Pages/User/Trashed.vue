<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Deleted Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deleted Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <PrimaryButton>
                    <Link :href="route('user.index')">
                        View All Users
                    </Link>
                </PrimaryButton>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 text-gray-900" v-if="users">
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                            </tr>

                            <tr v-for="user in users" :key="user.id">
                                <td>{{ user.fullName }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type }}</td>
                                <td>
                                    <PrimaryButton @click="restoreUser">
                                        Restore
                                    </PrimaryButton>
                                </td>
                                <td>
                                    <DangerButton @click="forceDeleteUser(user)">
                                        Force Delete
                                    </DangerButton>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="p-6 text-gray-900" v-else>
                        <p>No deleted users found</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    components: {
        PrimaryButton
    },
    props: {
        users: {
            type: Array,
            required: true
        }
    },
    methods: {
        forceDeleteUser(user) {
            if (confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')) {
                Inertia.delete(`/users/${user.id}/forceDelete`);
            }
        },
        restoreUser(user) {
            if (confirm('Are you sure you want to restore this user?')) {
                Inertia.post(`/users/${user.id}/restore`);
            }
        },
    },
};
</script>
