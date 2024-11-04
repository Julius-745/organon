<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200">
        <!-- Card -->
        <div class="card w-full max-w-sm shadow-lg bg-base-100">
            <div class="card-body">

                <div class="w-16 mx-auto">
                    <ApplicationMark />
                </div>

                <!-- Status message -->
                <div v-if="status" class="alert alert-success shadow-lg mb-4">
                    {{ status }}
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="w-full">
                    <!-- Email -->
                    <div class="form-control mb-4">
                        <label class="label" for="email">Email</label>
                        <input id="email" v-model="form.email" type="email" placeholder="Enter your email"
                            class="input input-bordered w-full" required autofocus autocomplete="username" />
                        <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password -->
                    <div class="form-control mb-4">
                        <label class="label" for="password">Password</label>
                        <input id="password" v-model="form.password" type="password" placeholder="Enter your password"
                            class="input input-bordered w-full" required autocomplete="current-password" />
                        <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <!-- Remember me -->
                    <div class="form-control mb-4">
                        <label class="label cursor-pointer">
                            <input type="checkbox" v-model="form.remember" class="checkbox checkbox-primary" />
                            <span class="label-text ms-2 me-auto">Remember me</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-between items-center">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="link link-hover text-sm">
                        Forgot your password?
                        </Link>

                        <button type="submit" class="btn btn-primary" :class="{ 'loading': form.processing }"
                            :disabled="form.processing">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
