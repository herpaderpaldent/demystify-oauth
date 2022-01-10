<template>
  <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
    <h2>Login/Register User</h2>
    <p>Next up, we need to register a user who is able to authorize a client access to its resources: </p>
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
        <p class="mt-1 hidden xl:block">
          To login/register please use the form to the right.
        </p>
        <p class="mt-1 xl:hidden">
          To login/register please use the form below.
        </p>
      </div>
    </div>
    <p>Please note, that you are not obliged to use a valid mail address.</p>
    <User />
  </div>
</template>

<script>
import { BeakerIcon } from '@heroicons/vue/outline'
import User from "@/Components/RightSidebar/User";
export default {
  name: "Step2",
  components: {
    User,
    BeakerIcon
  }
}
</script>

<style scoped>

</style>
