<script setup>
import { Inertia } from '@inertiajs/inertia';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

</script>

<template>
    <div>
        <h1>Users</h1>

        <router-link :to="{ name: 'user.create'}">
            <PrimaryButton>Create</PrimaryButton>
        </router-link>

        <router-link :to="{ name: 'user.trashed'}">
            <SecondaryButton>View Deleted Users</SecondaryButton>
        </router-link>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
            </tr>

            <tr v-for="user in users" :key="user.id">
                <router-link :to="{ name: 'user.show', params: { id: user.id }}">
                    {{ user.fullName }}
                </router-link>
                <td>{{ user.email }}</td>
                <td>{{ user.type }}</td>
                <td>
                    <router-link :to="{ name: 'user.edit', params: { user: user }}">
                        <PrimaryButton>Edit</PrimaryButton>
                    </router-link>
                </td>
                <td>
                    <DangerButton @click="deleteUser">
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
        deleteUser() {
            if (confirm('Are you sure?')) {
                Inertia.delete(`/users/${this.user.id}`);
            }
        },
    },
};
</script>
