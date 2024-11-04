<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Secure Area" />

    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200">
        <div class="card w-full max-w-sm shadow-lg bg-base-100">
            <div class="card-body">
                <div class="w-16 mx-auto">
                    <ApplicationMark />
                </div>

                <div class="my-4">
                    This is a secure area of the application. Please confirm your password before continuing.
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <label for="password" class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="input input-bordered w-full"
                            required
                            autocomplete="current-password"
                            autofocus
                        />
                        <p v-if="form.errors.password" class="text-error text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button
                            type="submit"
                            class="btn btn-primary w-full"
                            :class="{ 'loading': form.processing }"
                            :disabled="form.processing"
                        >
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
