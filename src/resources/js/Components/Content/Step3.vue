<template>
  <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
    <h2>Authorize client</h2>
    <p>Now that we have <b>client</b> and a <b>user</b> we can do the following:</p>
    <ol>
      <li>As client ask the resource owner (user) to authorize access to the resource server</li>
      <li>Receive the Authorization Code</li>
    </ol>
    <p>
      From the RFC <a
        href="https://datatracker.ietf.org/doc/html/rfc6749#section-4.1.1"
        target="_blank"
      >Section 4.1.1</a>:
    </p>
    <blockquote>
      <p>
        The client directs the resource owner to the constructed URI using an
        HTTP redirection response, or by other means available to it via the
        user-agent.
        The authorization server validates the request to ensure that all
        required parameters are present and valid.  If the request is valid,
        the authorization server authenticates the resource owner and obtains
        an authorization decision (by asking the resource owner or by
        establishing approval via other means). <br>

        When a decision is established, the authorization server directs the
        user-agent to the provided client redirection URI using an HTTP
        redirection response, or by other means available to it via the
        user-agent.
      </p>
    </blockquote>
    <p>
      Taking not of the following sentence: <code>the [...] server directs the user-agent to the provided client redirection URI</code>
      this would require a valid <code>redirect_uri</code>. This demo application actually returns the authorization code to the URI.
      However, if you do not feel programming a valid client, the site will return the payload of such redirect response.
    </p>
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
          click on the button and follow the constructor URI.
          <button
            type="button"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            @click="popup"
          >
            Ask user for authorization
          </button>
        </p>
      </div>
    </div>

    <hr>
    <h3>
      Redirect Response
    </h3>
    <p>
      Please note, the received code is only valid for a limited period of time, hence it is very likely that you need to generate a second one
      Below the most recent response from the authorization server is highlighted by the purple background.
    </p>

    <Authentication @request-received="processCode" />
    <hr>
  </div>
</template>

<script>
import { BeakerIcon } from '@heroicons/vue/outline'
import {computed, ref} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";
import Authentication from "@/Components/ClientInteractions/Authentication";
import {Inertia} from "@inertiajs/inertia";

export default {
  name: "Step3",
  components: {
    Authentication,
    BeakerIcon
  },
emits: ['authorization-code'],
  setup(params, {emit}) {

    const uri = computed(() => {

      let client_id = usePage().props.value.client.client_id

      function base64EncodeUnicode(str) {
        // Firstly, escape the string using encodeURIComponent to get the UTF-8 encoding of the characters,
        // Secondly, we convert the percent encodings into raw bytes, and add it to btoa() function.
        let utf8Bytes = encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function (match, p1) {
          return String.fromCharCode('0x' + p1);
        });

        return btoa(utf8Bytes);
      }

      let state = base64EncodeUnicode(new Date+1 + 'An opaque value used by the client to maintain state between the request and callback.The authorization server includes this value when redirecting the user-agent back to the client. The parameter SHOULD be used for preventing ccross-site request forgery as described in Section 10.12.')

      const url = new URL(`${location.origin}/authorization-code/auth`);
      url.searchParams.append('client_id', client_id)
      url.searchParams.append('response_type', 'code')
      url.searchParams.append('redirect_uri', usePage().props.value.client.redirect_uri)
      url.searchParams.append('state', state)

      return url.href

    })

    const windowRef = ref()

    const popup =  () => {
      let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=600,height=300`;

      windowRef.value = open(uri.value, 'Authorization Request', params);
    }

    const processCode = () => {

      if(windowRef.value){
        windowRef.value.close()
      }

      Inertia.reload({
        only: ['currentStep'],
        preserveScroll: true
      })

    }

    return {
      popup,
      processCode,
      uri
    }
  }
}
</script>

<style scoped>

</style>
