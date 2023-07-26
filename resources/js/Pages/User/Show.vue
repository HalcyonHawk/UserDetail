<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <Head title="User Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Details</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <PrimaryButton>
                            <Link :href="route('user.index')">
                                View All Users
                            </Link>
                        </PrimaryButton>

                        <PrimaryButton>
                            <Link :href="route('user.edit', {user: user})">
                                Edit
                            </Link>
                        </PrimaryButton>

                        <DangerButton @click="deleteUser(user)">
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

                        <div>
                            <h2>Gender:</h2>
                            <p>{{ user.gender }}</p>
                        </div>
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
        user: Object
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
