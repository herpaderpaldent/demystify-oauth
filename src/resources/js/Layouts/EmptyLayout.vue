<template>
  <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
    name: "EmptyLayout"
}
</script>

<style scoped>

</style>
