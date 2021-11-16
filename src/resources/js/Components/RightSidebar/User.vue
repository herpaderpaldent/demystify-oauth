<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-lg" />
  <div
    v-if="user"
    class="bg-white shadow overflow-hidden sm:rounded-lg"
  >
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        User
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
        You are logged in as
      </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            Name
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ user.name }}
          </dd>
        </div>
      </dl>
    </div>
  </div>

  <div
    v-else
    class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10"
  >
    <form
      class="space-y-6"
      @submit.prevent="submit"
    >
      <div>
        <label
          for="email"
          class="block text-sm font-medium text-gray-700"
        >
          Email address
        </label>
        <div class="mt-1">
          <input
            id="email"
            v-model="form.email"
            name="email"
            type="email"
            autocomplete="username"
            required
            autofocus
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          >
        </div>
      </div>
      <p
        v-if="form.errors.email"
        class="mt-2 text-sm text-red-600"
      >
        {{ form.errors.email }}
      </p>

      <div>
        <label
          for="password"
          class="block text-sm font-medium text-gray-700"
        >
          Password
        </label>
        <div class="mt-1">
          <input
            id="password"
            v-model="form.password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          >
        </div>
      </div>
      <p
        v-if="form.errors.password"
        class="mt-2 text-sm text-red-600"
      >
        {{ form.errors.password }}
      </p>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input
            id="remember-me"
            v-model="form.remember"
            name="remember-me"
            type="checkbox"
            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
          >
          <label
            for="remember-me"
            class="ml-2 block text-sm text-gray-900"
          >
            Remember me
          </label>
        </div>

        <div class="text-sm">
          <a
            href="#"
            class="font-medium text-indigo-600 hover:text-indigo-500"
            @click="open = true"
          >
            Register
          </a>
        </div>
      </div>

      <div>
        <button
          type="submit"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Sign in
        </button>
      </div>
    </form>


    <Modal v-model="open">
      <div>
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
          <UserAddIcon
            class="h-6 w-6 text-green-600"
            aria-hidden="true"
          />
        </div>
        <div class="mt-3 text-center sm:mt-5">
          <DialogTitle
            as="h3"
            class="text-lg leading-6 font-medium text-gray-900"
          >
            Register an user
          </DialogTitle>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              We need a user to retrieve information from. Maybe use a catchy name that you recognize late f.e. Rick Astley.
            </p>
          </div>
        </div>
        <RegistrationForm />
      </div>
    </Modal>
  </div>
</template>
<script>
import Modal from "@/Components/Modal";
import {DialogTitle} from "@headlessui/vue";
import {UserAddIcon} from "@heroicons/vue/outline";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import {computed, ref} from "vue";
import route from 'ziggy'
import RegistrationForm from "@/Components/Auth/RegistrationForm";

export default {
  name: "User",
  components: {
    RegistrationForm,
    Modal,
    DialogTitle,
    UserAddIcon
  },
  setup() {
    const open = ref(false)
    const form = useForm({
      email: '',
      password: '',
      remember: false
    })

    const registerForm = useForm({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      terms: false,
    })

    const user = computed(() => usePage().props.value.auth.user)

    function submit() {
      form.post(route('login'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password')
      })
    }

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
      open,
      form,
      submit,
      registerForm,
      user,
      register
    }
  },
}
</script>

<style scoped>

</style>
