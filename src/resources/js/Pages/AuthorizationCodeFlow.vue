<template>
  <Head title="Authorization Code Flow" />
  <div class="rounded-lg py-16 bg-white overflow-hidden shadow">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="text-lg max-w-prose mx-auto">
        <h1>
          <span class="block text-base text-center text-indigo-600 font-semibold tracking-wide uppercase">Demystify oAuth</span>
          <span class="mt-2 block text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">Introduction</span>
        </h1>
        <p class="mt-8 text-xl text-gray-500 leading-8">
          The overall goal of this page is to provide readers with a short playbook for readers to play through the <strong>authorization code flow</strong>. This playbook will teach the very basic of an authentication flow.
        </p>
      </div>
      <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
        <blockquote>
          The OAuth 2.0 authorization framework enables a third-party
          application to obtain limited access to an HTTP service, either on
          behalf of a resource owner by orchestrating an approval interaction
          between the resource owner and the HTTP service, or by allowing the
          third-party application to obtain access on its own behalf.  This
          specification replaces and obsoletes the OAuth 1.0 protocol described
          in RFC 5849.

          Source: <a href="https://datatracker.ietf.org/doc/html/rfc6749">RFC 6749</a>
        </blockquote>
        <p>The Authorization Code grant type is used by web and mobile apps (client). It differs from most of the other grant types by first requiring the app launch a browser to begin the flow. At a high level, the flow has the following steps:</p>
        <figure>
          <img
            class="w-full rounded-lg"
            src="/images/zc_api_oauth.png"
            alt=""
            width="870"
            height="796"
          >
          <figcaption>Flow diagram of the <strong>authorization code grant flow</strong>.</figcaption>
        </figure>
        <ul role="list">
          <li>The application (client) opens a browser to send the user (resource owner) to the OAuth server</li>
          <li>The user sees the authorization prompt and approves the app’s request</li>
          <li>The user is redirected back to the application with an authorization code in the query string</li>
          <li>The application exchanges the authorization code for an access token</li>
        </ul>
        <p>In order for you to follow this playbook it is not required for you to actually create/implement a client which actually receives the authorization grant. We will use <a href="https://oauth.herpaderpaldent.ch/">https://oauth.herpaderpaldent.ch/</a> to present you with the «authorization grant» payload to continue the playbook. However if you feel like it, you might as well create your own application as the application does a real redirect after broadcasting the payload.</p>
      </div>
      <Step1 />
      <Step2
        v-show="currentStep >= 2"
        id="step2"
      />
      <Step3 v-if="currentStep >= 3" />
      <Step4 v-if="currentStep >= 4" />
      <Step5 v-if="currentStep >= 5" />
    </div>
  </div>
</template>


<script>
import ConstrainedStickyColumnsLayout from "@/Layouts/ConstrainedStickyColumnsLayout";
import Step1 from "@/Components/Content/Step1";
import Step2 from "@/Components/Content/Step2";
import Step3 from "@/Components/Content/Step3";
import Step4 from "@/Components/Content/Step4";
import Step5 from "@/Components/Content/Step5";
import { Head } from '@inertiajs/inertia-vue3'

export default {
  name: "AuthorizationCodeFlow",
  components: {Step5, Step4, Step3, Step2, Step1, Head},
  layout: ConstrainedStickyColumnsLayout,
  props: {
    currentStep: {
      type: Number,
      required: true
    }
  },
}
</script>
