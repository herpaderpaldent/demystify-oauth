<template>
  <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
    <h2>Register Client</h2>
    <p>It is vital for any oAuth case that the client who wishes to access resources of the resource owner to register with the authentication server. After registration you will gain a <code>client_id</code> and <code>client_secret</code>. </p>
    <p>Usually several information are requested from a client application, such as the <em>app name</em>, <em>contact data</em> and some kind of <em>description</em> what the apps aim to accomplish. Very importantly the registration is always going to require a authorization <strong>callback url</strong>. The callback URL is used to determine where the auth server redirects the user after they authorize your access request, and it can include query parameters. The redirect will include the same query parameters, as well as the access token, which your application must be able to parse.</p>
    <!-- This example requires Tailwind CSS v2.0+ -->

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
        <p class="mt-1 xl:hidden">
          To register client, press the button bellow and follow the instructions.
        </p>
        <p class="mt-1 hidden xl:block">
          To register client, press the button in the right column and follow the instructions.
        </p>
      </div>
    </div>

    <div class="xl:hidden">
      <Application />
    </div>
  </div>
</template>

<script>
import { BeakerIcon } from '@heroicons/vue/outline'
import Application from "@/Components/RightSidebar/Application";
export default {
  name: "Step1",
  components: {
    Application,
    BeakerIcon
  }
}
</script>

<style scoped>

</style>
