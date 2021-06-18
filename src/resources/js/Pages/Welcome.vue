<template>
  <Hero/>
  <!-- Alternating Feature Sections -->
  <div class="relative pt-16 pb-32 overflow-hidden">
    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-gray-100" />
    <div class="relative">
      <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:grid-flow-col-dense lg:gap-24">
        <div class="px-4 max-w-xl mx-auto sm:px-6 lg:py-16 lg:max-w-none lg:mx-0 lg:px-0 lg:py-32">
          <div>
            <div>
              <span class="h-12 w-12 rounded-md flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600">
                <PencilAltIcon class="h-6 w-6 text-white" aria-hidden="true" />
              </span>
            </div>
            <div class="mt-6">
              <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                Register your Application
              </h2>
              <p class="mt-4 text-lg text-gray-500">
                It is vital for any oAuth Case that the client who wishes to access resources of the resource owner to register with the authentication server. After registration you will gain a <code class="text-purple-600">client_id</code> and <code class="text-purple-600">client_secret.</code>
              </p>
              <div class="mt-6">
                <inertia-link :href="route('register.client')" class="inline-flex px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                  Get started
                </inertia-link>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-12 sm:mt-16 lg:mt-0">
          <div class="pl-4 -mr-48 sm:pl-6 md:-mr-16 lg:px-0 lg:m-0 lg:relative lg:h-full">
            <img
                    class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                    :src="register_application"
                    alt="Inbox user interface" />
          </div>
        </div>
      </div>
    </div>
    <div class="mt-24">
      <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:grid-flow-col-dense lg:gap-24">
        <div class="px-4 max-w-xl mx-auto sm:px-6 lg:py-32 lg:max-w-none lg:mx-0 lg:px-0 lg:col-start-2">
          <div>
            <div>
                  <span class="h-12 w-12 rounded-md flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600">
                    <SparklesIcon class="h-6 w-6 text-white" aria-hidden="true" />
                  </span>
            </div>
            <div class="mt-6">
              <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                No backend needed
              </h2>
              <p class="mt-4 text-lg text-gray-500">
                The authorized user is usually redirected back back to the application specified <code class="text-purple-600">redirect_url</code> containing a code which is required to acquire the access token via the <b>backchannel</b> authorization grant. This application will receive said callback for you so you'll be able to use the code with your curl.
              </p>
              <div class="mt-6">
                <inertia-link :href="route('login')" class="inline-flex px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                  Login
                </inertia-link>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-12 sm:mt-16 lg:mt-0 lg:col-start-1">
          <div class="pr-4 -ml-48 sm:pr-6 md:-ml-16 lg:px-0 lg:m-0 lg:relative lg:h-full">
            <img
                    v-if="view_appliaction"
                    class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
                    :src="view_appliaction"
                    alt="Application view" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
    PencilAltIcon, SparklesIcon
} from '@heroicons/vue/outline'
import Guest from "@/Layouts/Guest";
import Hero from "@/Components/Guest/Hero";

export default {
    name: "Welcome",
    layout: Guest,
    components: {
        Hero,
        Guest,
        PencilAltIcon,
        SparklesIcon
    },
    props: {
        register_application: String,
        view_appliaction: String
    }
}
</script>