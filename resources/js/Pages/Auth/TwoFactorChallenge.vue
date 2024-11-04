<script setup>
import { nextTick, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>
    <Head title="Two-factor Confirmation" />

    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200">
        <div class="card w-full max-w-sm shadow-lg bg-base-100">
            <div class="card-body">
                  
                <div class="w-16 mx-auto">
                    <ApplicationMark />
                </div>

                <p class="text-sm text-gray-600 mb-4">
                    <template v-if="!recovery">
                        Please confirm access to your account by entering the authentication code from your app.
                    </template>
                    <template v-else>
                        Please confirm access to your account by entering one of your emergency recovery codes.
                    </template>
                </p>

                <form @submit.prevent="submit">
                    <div v-if="!recovery">
                        <label for="code" class="label">Code</label>
                        <input
                            id="code"
                            ref="codeInput"
                            v-model="form.code"
                            type="text"
                            inputmode="numeric"
                            class="input input-bordered w-full mb-2"
                            autofocus
                            autocomplete="one-time-code"
                        />
                        <p v-if="form.errors.code" class="text-red-500 text-sm">{{ form.errors.code }}</p>
                    </div>

                    <div v-else>
                        <label for="recovery_code" class="label">Recovery Code</label>
                        <input
                            id="recovery_code"
                            ref="recoveryCodeInput"
                            v-model="form.recovery_code"
                            type="text"
                            class="input input-bordered w-full mb-2"
                            autocomplete="one-time-code"
                        />
                        <p v-if="form.errors.recovery_code" class="text-red-500 text-sm">{{ form.errors.recovery_code }}</p>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button
                            type="button"
                            class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                            @click.prevent="toggleRecovery"
                        >
                            <template v-if="!recovery">
                                Use a recovery code
                            </template>
                            <template v-else>
                                Use an authentication code
                            </template>
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary ml-4"
                            :class="{ 'loading': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
