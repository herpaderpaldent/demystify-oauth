<template>
  <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
    <h2>Exchange authorization Code for an access token</h2>
    <p>
      Up until now everything went over the <strong>front channel</strong> which means, we navigated from the client to
      the authorization server using the resource owners browser and received back an authorization code via URL parameter.
      With the obtained code you might exchange the code for an <code>authorization token</code> and optionally
      a <code>refresh_token</code>. This is done on the <strong>back channel</strong> via a POST Request from the
      client directly to the authorization server as a means of secure channel compared to potential MIM Attacks on
      the front channel
    </p>
    <pre>
      <code class="language-curl">
<b>POST</b> /api/authorization-code/token HTTP/1.1
Host: {{ host }}
Content-Type: application/<b>x-www-form-urlencoded</b>
Content-Length: 152

grant_type=authorization_code&client_id={{ client_id }}&client_secret={{ client_secret }}&code={{ code }}
      </code>
    </pre>
    <div class="flex">
      <div class="mr-4 flex-shrink-0">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100">
          <BeakerIcon class="h-6 w-6 text-indigo-600" />
        </div>
      </div>
      <div>
        <h4 class="text-lg font-bold">
          Action
        </h4>
        <p class="mt-1">
          Get an access token with the provided information above. Please assure yourself that client_id, client_secret and code match for your test.
        </p>
      </div>
    </div>
    <hr>
    <h3>Access resource</h3>
    <p>Using the access token as <code>bearer</code> we are now able to access the resource, authenticated as resource owner providing the access token</p>
    <div class="flex">
      <div class="mr-4 flex-shrink-0">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100">
          <BeakerIcon class="h-6 w-6 text-indigo-600" />
        </div>
      </div>
      <div>
        <h4 class="text-lg font-bold">
          Action
        </h4>
        <p class="mt-1">
          Try getting the user information from the api: <code>GET {{ base_url }}/api/user</code> and the access token as <code>bearer</code> <br>
        </p>
      </div>
    </div>
    <p>The request should be something like this:</p>
    <pre>
      <code class="language-curl">
<b>GET</b> /api/user HTTP/1.1
bearer: <b>YOUR ACCESS TOKEN</b>
Accept: */*
Host: {{ host }}
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
      </code>
    </pre>
    <p>as a result you should get a <code>JSON</code> Response containing the user-model including the mail you entered and <code>user_id</code></p>
    <button
      type="button"
      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      @click="next"
    >
      Click here for the next step
    </button>
  </div>
</template>

<script>
import {usePage} from "@inertiajs/inertia-vue3";
import {computed} from "vue";
import { BeakerIcon } from '@heroicons/vue/outline'

export default {
  name: "Step4",
  components: {BeakerIcon},
  setup() {
    const client_id = computed(() => usePage().props.value.client.client_id)
    const client_secret = computed(() => usePage().props.value.client.client_secret)
    const code = computed(() => usePage().props.value.code)
    const host = window.location.host
    const base_url = window.location.origin

    const next = function () {
      usePage().props.value.currentStep++
    }

    return {
      client_id,
      client_secret,
      code,
      host,
      next,
      base_url
    }
  }
}
</script>

<style scoped>

</style>
