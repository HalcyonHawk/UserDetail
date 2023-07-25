<script setup>
import { Inertia } from '@inertiajs/inertia';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

</script>

<template>
    <div>
        <h1>Deleted Users</h1>

        <router-link :to="{ name: 'user.index'}">
            <PrimaryButton>View Active Users</PrimaryButton>
        </router-link>

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
                    <DangerButton @click="forceDeleteUser">
                        Delete
                    </DangerButton>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    components: {
        PrimaryButton
    },
    props: {
        user: Object
    },
    methods: {
        forceDeleteUser() {
            if (confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')) {
                Inertia.delete(`/users/${this.user.id}/forceDelete`);
            }
        },
        restoreUser() {
            if (confirm('Are you sure you want to restore this user?')) {
                Inertia.post(`/users/${this.user.id}/restore`);
            }
        },
    },
};
</script>
