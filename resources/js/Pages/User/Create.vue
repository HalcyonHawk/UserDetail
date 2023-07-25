<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    prefix: '',
    firstname: '',
    middlename: '',
    lastname: '',
    suffix: '',
    photo: '',
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('user.store'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Create New User" />

        <h1>Create User</h1>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="prefix" value="Prefix" />

                <select id="prefix" v-model="form.prefix">
                    <option v-for="(prefix, index) in prefixes" :key="index">
                        {{ prefix }}
                    </option>
                </select>

                <InputError class="mt-2" :message="form.errors.prefix" />
            </div>

            <div>
                <InputLabel for="firstname" value="Firstname" />

                <TextInput
                    id="firstname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.firstname"
                    required
                    autocomplete="firstname"
                />

                <InputError class="mt-2" :message="form.errors.firstname" />
            </div>

            <div>
                <InputLabel for="middlename" value="Name" />

                <TextInput
                    id="middlename"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.middlename"
                    autocomplete="middlename"
                />

                <InputError class="mt-2" :message="form.errors.middlename" />
            </div>

            <div>
                <InputLabel for="lastname" value="Lastname" />

                <TextInput
                    id="lastname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lastname"
                    required
                    autocomplete="lastname"
                />

                <InputError class="mt-2" :message="form.errors.lastname" />
            </div>

            <div>
                <InputLabel for="suffix" value="Suffix" />

                <TextInput
                    id="suffix"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.suffix"
                    autocomplete="suffix"
                />

                <InputError class="mt-2" :message="form.errors.suffix" />
            </div>

            <div>
                <InputLabel for="photo" value="Photo" />

                <input
                    id="photo"
                    type="file"
                    class="mt-1 block w-full"
                    v-on:change="handleFileUpload($event)"
                />

                <InputError class="mt-2" :message="form.errors.photo" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script>
//Get prefixes for dropdown
export default {
    data() {
        return {
        form: {
            prefix: '',
            errors: {}
        },
        prefixes: [],
        };
    },
    created() {
        fetch('/api/prefixes')
        .then(response => response.json())
        .then(data => (this.prefixes = data.prefixes));
    },
};
</script>
