<template>
  <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
    <h2>Refresh Token</h2>
    <p>
      Because the authorization token is being used as bearer token it is considered as unsafe.
      Hence, the <code>access_token</code> does expires in a given set of time.
      Some times you receive an optional <strong>refresh_token</strong> you can use to receive a new set of tokens whenever the access_token is expired.
    </p>
    <blockquote>
      If the authorization server issued a refresh token to the client, the
      client makes a refresh request to the token endpoint <br>
      Source: <a href="https://datatracker.ietf.org/doc/html/rfc6749#section-6">RC 6749 Section 6</a>
    </blockquote>
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
          Try refreshing your tokens with the provided information below. Please assure yourself that client_id, client_secret and code match for your test.
        </p>
      </div>
    </div>
    <pre>
      <code class="language-curl">
<b>POST</b> /api/authorization-code/token HTTP/1.1
Host: {{ host }}
Content-Type: application/<b>x-www-form-urlencoded</b>
Content-Length: 152

grant_type=refresh_token&refresh_token=<b>YOURTOKEN</b>
      </code>
    </pre>
    <div class="flex">
      <div class="mr-4 flex-shrink-0">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
          <CheckIcon class="h-6 w-6 text-green-600" />
        </div>
      </div>
      <div>
        <h4 class="text-lg font-bold">
          Hey you have made it!
        </h4>
        <p class="mt-1">
          Before you reset the application: If you have any feedback, questions etc. please let me know f.e. on <a href="https://twitter.com/huberfe/">Twitter</a>
          or on <a href="https://github.com/herpaderpaldent/demystify-oauth/issues/new">Github</a> Click on the button to reset the application
        </p>
        <Link
          :href="logout"
          as="button"
          method="post"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Reset everything
        </Link>
      </div>
    </div>
  </div>
</template>

<script>
import { BeakerIcon, CheckIcon } from '@heroicons/vue/outline'
import { Link } from '@inertiajs/inertia-vue3'
import route from 'ziggy'

export default {
  name: "Step5",
  components: {
    BeakerIcon,
    CheckIcon,
    Link
  },
  setup() {
    return {
      host: window.location.host,
      logout: route('logout')
    }
  }
}
</script>

<style scoped>

</style>
