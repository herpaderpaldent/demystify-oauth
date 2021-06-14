<template>
  <Layout>
    <!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->

      <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Subscribe to Auth
          </h3>
          <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>
              Enter your applications <code>client_id</code> to subscripe to interactions with the authorization server bound to the same client.
            </p>
          </div>
          <div class="mt-5 sm:flex sm:items-center">
            <div class="w-full sm:max-w-xs">
              <label for="client_id" class="sr-only">Email</label>
              <input v-model="client_id" type="number" name="client_id" id="client_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="133742111" />
            </div>
            <button @click="subscribe" type="submit" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              Subscribe
            </button>
          </div>
        </div>
      </div>

    <Authentication v-if="client" :client_id="client" />


  </Layout>
</template>

<script>
import Layout from "@/Layouts/Layout";
import {ref} from "vue";
import Authentication from "@/Components/ClientInteractions/Authentication";
export default {
    name: "Dashboard",
    components: {Authentication, Layout},
    setup() {

        const client_id = ref(null)

        const client = ref(null)

        const subscribe = () => client.value = Number(client_id.value);

        return {
            subscribe,
            client_id,
            client
        }

    }
}
</script>

<style scoped>

</style>