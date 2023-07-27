<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia'

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deleted Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('user.index')">
                    <PrimaryButton>
                        View All Users
                    </PrimaryButton>
                </Link>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 text-gray-900" v-if="users.length > 0">
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Deleted At</th>
                            </tr>

                            <tr v-for="user in users" :key="user.id">
                                <td>{{ user.fullName }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type }}</td>
                                <td>{{ user.deleted_at }}</td>
                                <td>
                                    <PrimaryButton @click="restoreUser(user)">
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
                Inertia.post(user.force_delete_url, {
                    _method: 'delete'
                })
            }
        },
        restoreUser(user) {
            if (confirm('Are you sure you want to restore this user?')) {
                Inertia.post(user.restore_url, {
                    _method: 'patch'
                })
            }
        },
    },
};
</script>
