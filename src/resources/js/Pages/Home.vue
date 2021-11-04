<template>
  <Head title="Home" />
  <Header />
  <div class="bg-gray-50">
    <div class="relative overflow-hidden">
      <div
        class="absolute inset-y-0 h-full w-full"
        aria-hidden="true"
      >
        <div class="relative h-full">
          <svg
            class="absolute right-full transform translate-y-1/3 translate-x-1/4 md:translate-y-1/2 sm:translate-x-1/2 lg:translate-x-full"
            width="404"
            height="784"
            fill="none"
            viewBox="0 0 404 784"
          >
            <defs>
              <pattern
                id="e229dbec-10e9-49ee-8ec3-0286ca089edf"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse"
              >
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200"
                  fill="currentColor"
                />
              </pattern>
            </defs>
            <rect
              width="404"
              height="784"
              fill="url(#e229dbec-10e9-49ee-8ec3-0286ca089edf)"
            />
          </svg>
          <svg
            class="absolute left-full transform -translate-y-3/4 -translate-x-1/4 sm:-translate-x-1/2 md:-translate-y-1/2 lg:-translate-x-3/4"
            width="404"
            height="784"
            fill="none"
            viewBox="0 0 404 784"
          >
            <defs>
              <pattern
                id="d2a68204-c383-44b1-b99f-42ccff4e5365"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse"
              >
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200"
                  fill="currentColor"
                />
              </pattern>
            </defs>
            <rect
              width="404"
              height="784"
              fill="url(#d2a68204-c383-44b1-b99f-42ccff4e5365)"
            />
          </svg>
        </div>
      </div>


      <div class="relative pt-6 pb-16 sm:pb-24">
        <div class="mt-16 mx-auto max-w-7xl px-4 sm:mt-24 sm:px-6">
          <div class="text-center">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
              <span class="block">Demystify</span>
              <span class="block text-indigo-600">oAuth</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
              Many developers do not fully understand how oAuth, PKCE, FIDO etc. really works. This Page aims to
              teach in an interactive way, a better understanding of how oAuth works.
            </p>
          </div>
        </div>
      </div>

      <div class="relative">
        <div
          class="absolute inset-0 flex flex-col"
          aria-hidden="true"
        >
          <div class="flex-1" />
          <div class="flex-1 w-full bg-gray-800" />
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <img
            class="relative rounded-lg shadow-lg"
            :src="exampleImage"
            alt="App screenshot"
          >
        </div>
      </div>
    </div>
    <div class="bg-gray-800">
      <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <h2 class="text-sm font-semibold tracking-wide uppercase">
          <span class="bg-gradient-to-r from-purple-300 to-indigo-300 bg-clip-text text-transparent">Dispel dark magic</span>
        </h2>
        <p class="mt-3 text-3xl font-extrabold text-white">
          Libraries reduce complexity yet at a price
        </p>
        <p class="mt-5 text-lg text-gray-300">
          At some point every developers faces the need to incorporate oAuth2 to an application. Mostly this is done by using a standard library, which works great.
          Yet, thanks to the library, developers do not need to fully understand the flow. This causes issues whenever some part of the authorization flow fails.
          Here this page tries to support developers, solution designers or requirements engineers in gaining a knowledge of the flow
        </p>
        <p class="mt-5 text-lg text-gray-300">
          Get your hands dirty, this app gives you an opportunity to interact with the authorization server just like a real one without needing to run/host your own application. You may however, both is fine.
        </p>

        <div class="mt-12 grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2">
          <p>
            <span class="block text-2xl font-bold text-white">Get your hands dirty</span>
            <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">Playful</span> get to know the oAuth2 flow first hand.</span>
          </p>

          <p>
            <span class="block text-2xl font-bold text-white">No application needed</span>
            <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">Recieve</span> authorization codes from the app or in your application if you wish.</span>
          </p>

          <p>
            <span class="block text-2xl font-bold text-white">Know how to POST</span>
            <span class="mt-1 block text-base text-gray-300"><span class="font-medium text-white">CURL</span> postman etc. To fully grasp the concepts you should be able to create a POST request.</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "@/Layouts/Header";
import { Head } from '@inertiajs/inertia-vue3'

export default {
  name: "Home",
  components: {
    Header,
    Head,
  },
  props: {
    exampleImage: {
      required: true,
      type: String
    }
  }
}
</script>
