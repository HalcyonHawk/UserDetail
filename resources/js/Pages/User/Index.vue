<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <PrimaryButton>
                    <Link :href="route('user.create')">
                        Create
                    </Link>
                </PrimaryButton>

                <SecondaryButton>
                    <Link :href="route('user.trashed')">
                        Deleted Users
                    </Link>
                </SecondaryButton>

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
                                    <PrimaryButton>
                                        <Link :href="route('user.show', {user: user})">
                                            View
                                        </Link>
                                    </PrimaryButton>
                                </td>
                                <td>
                                    <PrimaryButton>
                                        <Link :href="route('user.edit', {user: user})">
                                            Edit
                                        </Link>
                                    </PrimaryButton>
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
                Inertia.delete(`/users/${user.id}`);
            }
        },
    },
};
</script>
