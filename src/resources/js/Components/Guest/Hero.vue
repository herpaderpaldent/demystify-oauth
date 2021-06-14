<template>
  <div class="relative">
    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100" />
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="relative shadow-xl sm:rounded-2xl sm:overflow-hidden">
        <div class="absolute inset-0">
          <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2830&q=80&sat=-100" alt="People working on laptops" />
          <div class="absolute inset-0 bg-gradient-to-r from-purple-800 to-indigo-700 mix-blend-multiply" />
        </div>
        <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
          <h1 class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
            <span class="block text-white">Demystify modern authentication frameworks</span>
            <span class="block text-indigo-200">oAuth2, Open Id Connect, FIDO</span>
          </h1>
          <p class="mt-6 max-w-lg mx-auto text-center text-xl text-indigo-200 sm:max-w-3xl">
            This homepage will complete the oAuth, Open Id Connect and Fido wiki article and serves as graphical representation of things than can not properly be solved in ones curl, namely the authentication and later callback payload. The later you would need to have a publicly accessible endpoint to reach. This sites tries to simplify it.
          </p>
          <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
            <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
              <inertia-link :href="route('register.client')" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 sm:px-8">
                Register Application
              </inertia-link>
              <a href="#" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-500 bg-opacity-60 hover:bg-opacity-70 sm:px-8">
                Login
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: "Hero"
}
</script>

<style scoped>

</style>