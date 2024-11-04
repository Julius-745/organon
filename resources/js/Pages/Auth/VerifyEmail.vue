<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification" />

    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200">
        <div class="card w-full max-w-sm shadow-lg bg-base-100">
            <div class="card-body">
                
                <div class="w-16 mx-auto">
                    <ApplicationMark />
                </div>

                <p class="text-sm text-gray-600 mb-4">
                    Before continuing, please verify your email address by clicking on the link we just sent you. If you didn't receive it, we’ll send another.
                </p>

                <div v-if="verificationLinkSent" class="text-sm text-green-600 mb-4">
                    A new verification link has been sent to your email address.
                </div>

                <form @submit.prevent="submit">
                    <div class="flex items-center justify-between mt-4">
                        <button
                            type="submit"
                            class="btn btn-primary"
                            :class="{ 'loading': form.processing }"
                            :disabled="form.processing"
                        >
                            Resend Verification Email
                        </button>

                        <div class="text-sm">
                            <Link
                                :href="route('profile.show')"
                                class="link"
                            >
                                Edit Profile
                            </Link>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="link ml-2"
                            >
                                Log Out
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
