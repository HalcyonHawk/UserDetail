<script setup>
import { Inertia } from '@inertiajs/inertia';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

</script>

<template>
    <div>
        <h1>User Details</h1>

        <router-link :to="{ name: 'user.index'}">
            <PrimaryButton>View All Users</PrimaryButton>
        </router-link>

        <router-link :to="{ name: 'user.edit', params: { user: user }}">
            <PrimaryButton>Edit</PrimaryButton>
        </router-link>

        <DangerButton @click="deleteUser">
            Delete
        </DangerButton>

        <div>
            <img :src="user.profilePhoto" alt="User Photo" />
        </div>

        <div>
            <h2>Full Name:</h2>
            <p>{{ user.fullName }}</p>
        </div>

        <div>
            <h2>Email:</h2>
            <p>{{ user.email }}</p>
        </div>

        <div>
            <h2>Type:</h2>
            <p>{{ user.type }}</p>
        </div>

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
