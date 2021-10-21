<template>
  <div :class="['shadow-lg rounded-lg pointer-events-auto border', index > 0 ? 'bg-white': 'bg-indigo-50']">
    <div class="rounded-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
      <div class="p-4">
        <div class="flex items-start">
          <div class="ml-3 w-0 flex-1 pt-0.5">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Authorization Grant
            </h3>
            <div class="overflow-hidden py-4">
              <div class="border rounded-md border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                  <div
                    v-for="(data, data_title) in request.redirect_data"
                    :key="data_title"
                    class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                  >
                    <dt class="text-sm font-medium text-gray-500">
                      {{ data_title }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 break-words">
                      {{ data }}
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: "Request",
    props: {
        request: Object,
        index: Number
    }
}
</script>

<style scoped>

</style>
