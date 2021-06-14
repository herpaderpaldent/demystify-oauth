<template>
  <div class="bg-gray-100">
    <div class="max-w-7xl min-h-screen flex flex-col justify-center mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
      <div class="relative bg-white shadow-xl overflow-hidden sm:rounded-lg">
  <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Application Information
          </h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            <code>client_id</code> and <code>client_secret</code> of your application
          </p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
          <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                <code>client_id</code>
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ client_id }}
              </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                <code>client_secret</code>
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ client_secret }}
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import Guest from "@/Layouts/Guest";

export default {
    name: "Details",
    layout: Guest,
    props: {
        client_id: {
            type: Number,
            required: true
        },
        client_secret: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>

</style>