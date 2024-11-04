<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200">
        <div class="card w-full max-w-sm shadow-lg bg-base-100">
            <div class="card-body">
                
                <div class="w-16 mx-auto">
                    <ApplicationMark />
                </div>

                <form @submit.prevent="submit">
                    <!-- Name -->
                    <div class="form-control mb-4">
                        <label class="label" for="name">Name</label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            placeholder="Enter your name"
                            class="input input-bordered w-full"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                    </div>

                    <!-- Email -->
                    <div class="form-control mb-4">
                        <label class="label" for="email">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            placeholder="Enter your email"
                            class="input input-bordered w-full"
                            required
                            autocomplete="username"
                        />
                        <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password -->
                    <div class="form-control mb-4">
                        <label class="label" for="password">Password</label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            placeholder="Enter your password"
                            class="input input-bordered w-full"
                            required
                            autocomplete="new-password"
                        />
                        <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-control mb-4">
                        <label class="label" for="password_confirmation">Confirm Password</label>
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            placeholder="Confirm your password"
                            class="input input-bordered w-full"
                            required
                            autocomplete="new-password"
                        />
                        <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">{{ form.errors.password_confirmation }}</p>
                    </div>

                    <!-- Terms and Privacy Policy -->
                    <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="form-control mb-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" v-model="form.terms" class="checkbox checkbox-primary" required />
                            <span class="label-text ms-2">
                                I agree to the
                                <a :href="route('terms.show')" class="link link-hover">Terms of Service</a> and
                                <a :href="route('policy.show')" class="link link-hover">Privacy Policy</a>
                            </span>
                        </label>
                        <p v-if="form.errors.terms" class="text-red-500 text-sm mt-1">{{ form.errors.terms }}</p>
                    </div>

                    <!-- Register Button -->
                    <div class="flex justify-between items-center mt-4">
                        <Link :href="route('login')" class="link link-hover text-sm">
                            Already registered?
                        </Link>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :class="{ 'loading': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
