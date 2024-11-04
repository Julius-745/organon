<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200">
        <div class="card w-full max-w-sm shadow-lg bg-base-100">
            <div class="card-body">
                
                <div class="w-16 mx-auto">
                    <ApplicationMark />
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <label for="email" class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="input input-bordered w-full"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <p v-if="form.errors.email" class="text-error text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="input input-bordered w-full"
                            required
                            autocomplete="new-password"
                        />
                        <p v-if="form.errors.password" class="text-error text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation" class="label">
                            <span class="label-text">Confirm Password</span>
                        </label>
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="input input-bordered w-full"
                            required
                            autocomplete="new-password"
                        />
                        <p v-if="form.errors.password_confirmation" class="text-error text-sm mt-1">{{ form.errors.password_confirmation }}</p>
                    </div>

                    <div class="mt-6">
                        <button
                            type="submit"
                            class="btn btn-primary w-full"
                            :class="{ 'loading': form.processing }"
                            :disabled="form.processing"
                        >
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
