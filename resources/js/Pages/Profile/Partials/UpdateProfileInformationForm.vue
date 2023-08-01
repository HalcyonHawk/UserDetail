<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    prefixname: user.prefixame,
    firstname: user.firstname,
    middlename: user.middlename,
    lastname: user.lastname,
    suffixname: user.suffixname,
    email: user.email,
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <InputLabel for="prefixname" value="Prefix" />

                <select id="prefixname" v-model="form.prefixname"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option :value="null">Choose a prefix</option>
                    <option :value="Mr">Mr</option>
                    <option :value="Mrs">Mrs</option>
                    <option :value="Ms">Ms</option>
                </select>

                <InputError class="mt-2" :message="form.errors.prefixname" />
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
                <InputLabel for="suffixname" value="Suffix" />

                <TextInput
                    id="suffixname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.suffixname"
                    autocomplete="suffixname"
                />

                <InputError class="mt-2" :message="form.errors.suffixname" />
            </div>

            <div>
                <InputLabel for="photo" value="Photo" />

                <input
                    id="photo"
                    type="file"
                    class="mt-1 block w-full"
                    name="photo"
                />

                <InputError class="mt-2" :message="form.errors.photo" />
            </div>

            <div>
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

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
