<template>
  <form
    class="mt-6 grid grid-cols-1 gap-y-6"
    @submit.prevent="register"
  >
    <div class="sm:col-span-2">
      <label
        for="name"
        value="Name"
        class="block text-sm font-medium text-gray-900"
      >Name</label>
      <div class="mt-1">
        <input
          id="name"
          v-model="registerForm.name"
          type="text"
          required
          autocomplete="name"
          name="application_name"
          class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
        >
      </div>
    </div>
    <div class="sm:col-span-2">
      <label
        for="register-email"
        class="block text-sm font-medium text-gray-900"
      >Email</label>
      <div class="mt-1">
        <input
          id="register-email"
          v-model="registerForm.email"
          type="email"
          required
          autocomplete="username"
          name="register-email"
          class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
        >
      </div>
    </div>
    <div class="sm:col-span-2">
      <label
        for="register-password"
        class="block text-sm font-medium text-gray-900"
      >Password</label>
      <div class="mt-1 relative">
        <input
          id="register-password"
          v-model="registerForm.password"
          type="password"
          required
          autocomplete="new-password"
          name="register-password"
          :class="registerForm.errors.password ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' : 'text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300'"
          class="py-3 px-4 block w-full shadow-sm  rounded-md"
        >
        <div
          v-if="registerForm.errors.password"
          class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
        >
          <ExclamationCircleIcon
            class="h-5 w-5 text-red-500"
            aria-hidden="true"
          />
        </div>
      </div>
      <p
        v-if="registerForm.errors.password"
        id="email-error"
        class="mt-2 text-sm text-red-600"
      >
        {{ registerForm.errors.password }}
      </p>
    </div>
    <div class="sm:col-span-2">
      <label
        for="register_password_confirmation"
        class="block text-sm font-medium text-gray-900"
      >Confirm Password</label>
      <div class="mt-1">
        <input
          id="register_password_confirmation"
          v-model="registerForm.password_confirmation"
          type="password"
          required
          autocomplete="new-password"
          name="register_password_confirmation"
          class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
        >
      </div>
    </div>

    <div class="sm:col-span-2 sm:flex sm:justify-end">
      <button
        type="submit"
        :disabled="registerForm.processing"
        class="mt-2 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto"
      >
        Submit
      </button>
    </div>
  </form>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import { ExclamationCircleIcon } from '@heroicons/vue/solid'
import route from 'ziggy'

export default {
  name: "RegistrationForm",
  components: {
    ExclamationCircleIcon
  },
  setup() {

    const registerForm = useForm({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      terms: false,
    })

    function register() {
      registerForm.post(route('register'), {
        preserveScroll: true,
        onSuccess: () => {
          registerForm.reset('password', 'password_confirmation')
          open.value = false
        },
      })
    }

    return {
      registerForm,
      register
    }
  }
}
</script>

<style scoped>

</style>
