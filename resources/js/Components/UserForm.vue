<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { route } from '@/utils';

const props = defineProps({
    user: {
        type: Object,
        default: null
    }
});

//If user, use edit form. Else, use create form
let form = null;
if (props.user) {
    form = useForm(`EditUser:${user.id}`, {
        _method: 'put',
        prefixname: props.user.prefixname,
        firstname: props.user.firstname,
        middlename: props.user.middlename,
        lastname: props.user.lastname,
        suffixname: props.user.suffixname,
        email: props.user.email,
        password: null,
        photo: null,
    })
} else {
    form = useForm('CreateUser', {
        prefixname: null,
        firstname: '',
        middlename: '',
        lastname: '',
        suffixname: '',
        email: '',
        photo: '',
        password: '',

        errors: {}
    })
}

//Determine if update or store
function formSubmit() {
    props.user
    ? form.post(route('user.update', user.id).url())
    : form.post(route('user.store').url())
}
</script>


<template>
    <form @submit.prevent="formSubmit()" method="post">
        <!-- <div>
            <InputLabel for="prefixname" value="Prefix" />

            <select id="prefixname" v-model="form.prefixname">
                <option v-for="(prefix, index) in prefixes" :key="index">
                    {{ prefix }}
                </option>
            </select>

            <InputError class="mt-2" :message="form.errors.prefix" />
        </div> -->

        <div>
            <InputLabel for="prefixname" value="Prefix" />

            <select id="prefixname" v-model="form.prefixname"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option :value="null">Choose a prefix</option>
                <option :value="Mr">Mr</option>
                <option :value="Mrs">Mrs</option>
                <option :value="Ms">Ms</option>
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
            <InputLabel for="middlename" value="Middle name" />

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
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </div>
    </form>
</template>
