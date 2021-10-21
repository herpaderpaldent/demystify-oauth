<template>
  <div
    v-if="client"
    class="bg-white shadow overflow-hidden sm:rounded-lg"
  >
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Applicantion Information
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
        relevant parameters for requests with the auth server
      </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            client_id
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ client.client_id }}
          </dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            client_secret
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 break-words">
            {{ client.client_secret }}
          </dd>
        </div>
      </dl>
    </div>
  </div>

  <div
    v-else
    class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10"
  >
    <button
      type="submit"
      class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      @click="open = true"
    >
      Register an application
    </button>
    <Modal v-model="open">
      <div>
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
          <PlusIcon
            class="h-6 w-6 text-green-600"
            aria-hidden="true"
          />
        </div>
        <div class="mt-3 text-center sm:mt-5">
          <DialogTitle
            as="h3"
            class="text-lg leading-6 font-medium text-gray-900"
          >
            Register an application
          </DialogTitle>
          <div class="mt-2">
            <p class="text-sm text-gray-500">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur amet labore.
            </p>
          </div>
        </div>
        <form
          method="POST"
          class="mt-6 grid grid-cols-1 gap-y-6"
          @submit.prevent="submit"
        >
          <div class="sm:col-span-2">
            <label
              for="application_name"
              class="block text-sm font-medium text-gray-900"
            >Application Name</label>
            <div class="mt-1">
              <input
                id="application_name"
                v-model="form.application_name"
                type="text"
                name="application_name"
                class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
              >
            </div>
          </div>
          <div class="sm:col-span-2">
            <label
              for="callback_url"
              class="block text-sm font-medium text-gray-900"
            >Authorization callback URL</label>
            <div class="mt-1">
              <input
                id="callback_url"
                v-model="form.callback_url"
                type="text"
                name="callback_url"
                class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
              >
            </div>
            <p
              id="callback_url-description"
              class="mt-2 text-sm text-gray-500"
            >
              The callback URL is used to determine where the auth server redirects the user after they authorize your access request, and it can include query parameters. The redirect will include the same query parameters, as well as the access token, which your application must be able to parse.
            </p>
          </div>
          <div class="sm:col-span-2">
            <label
              for="email"
              class="block text-sm font-medium text-gray-900"
            >Email</label>
            <div class="mt-1">
              <input
                id="email"
                v-model="form.email"
                type="text"
                name="email"
                class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
              >
            </div>
          </div>
          <div class="sm:col-span-2">
            <div class="flex justify-between">
              <label
                for="message"
                class="block text-sm font-medium text-gray-900"
              >Message</label>
              <span
                id="message-max"
                class="text-sm text-gray-500"
              >Max. 500 characters</span>
            </div>
            <div class="mt-1">
              <textarea
                id="message"
                v-model="form.description"
                name="message"
                rows="4"
                class="py-3 px-4 block w-full shadow-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md"
                aria-describedby="message-max"
              />
            </div>
          </div>
          <div class="sm:col-span-2 sm:flex sm:justify-end">
            <button
              type="submit"
              :disabled="form.processing"
              class="mt-2 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </Modal>
  </div>
</template>
<script>
import Modal from "@/Components/Modal";
import {DialogTitle} from "@headlessui/vue";
import {PlusIcon} from "@heroicons/vue/outline";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import {computed, ref} from "vue";
import route from 'ziggy'

export default {
  name: "Application",
  components: {
    Modal,
    DialogTitle,
    PlusIcon
  },
  setup() {
    const open = ref(false)
    const form = useForm({
      application_name: 'name',
      callback_url: 'callback.url',
      email: 'user@test.ch',
      description: 'some text'
    })

    const client = computed(() => usePage().props.value.client)

    function submit() {
      form.post(route('create.client'), {
        preserveScroll: true,
        onSuccess: () => open.value = false
      })
    }

    return {
      open,
      form,
      client,
      submit
    }
  },
}
</script>

<style scoped>

</style>
