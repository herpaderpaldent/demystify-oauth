<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <!--        flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10-->
      <div class="items-center border-b-2 border-gray-100 py-6 grid grid-cols-2 md:grid-cols-3 justify-items-stretch">
        <!--        flex justify-start lg:w-0 lg:flex-1-->
        <div class="justify-self-start">
          <Link :href="route('home')">
            <span class="sr-only">Workflow</span>
            <ShieldCheckIcon class="h-8 w-auto sm:h-10 text-indigo-600" />
          </Link>
        </div>
        <div class="-mr-2 -my-2 md:hidden text-right">
          <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Open menu</span>
            <MenuIcon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </PopoverButton>
        </div>
        <!--        hidden md:flex space-x-10 justify-self-center-->
        <nav class="hidden md:flex space-x-10 justify-self-center">
          <Link
            v-for="link in links"
            :key="link.name"
            :href="link.href"
            class="text-base font-medium text-gray-500 hover:text-gray-900 capitalize"
          >
            {{ link.name }}
          </Link>
        </nav>
        <!--        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          <a
            href="#"
            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
          >
            Sign in
          </a>
          <a
            href="#"
            class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
          >
            Sign up
          </a>
        </div>-->
      </div>
    </div>

    <transition
      enter-active-class="duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="duration-100 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <PopoverPanel
        focus
        class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden z-10"
      >
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
          <div class="pt-5 pb-6 px-5">
            <div class="flex items-center justify-between">
              <div>
                <ShieldCheckIcon class="h-8 w-auto sm:h-10 text-indigo-600" />
              </div>
              <div class="-mr-2">
                <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                  <span class="sr-only">Close menu</span>
                  <XIcon
                    class="h-6 w-6"
                    aria-hidden="true"
                  />
                </PopoverButton>
              </div>
            </div>
            <!--            <div class="mt-6">
              <nav class="grid gap-y-8">
                <a
                  v-for="item in solutions"
                  :key="item.name"
                  :href="item.href"
                  class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                >
                  <component
                    :is="item.icon"
                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    {{ item.name }}
                  </span>
                </a>
              </nav>
            </div>-->
          </div>
          <div class="py-6 px-5 space-y-6">
            <div class="grid grid-cols-2 gap-y-4 gap-x-8">
              <Link
                v-for="link in links"
                :key="link.name"
                :href="link.href"
                class="text-base font-medium text-gray-900 hover:text-gray-700 capitalize"
              >
                {{ link.name }}
              </Link>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { Link } from '@inertiajs/inertia-vue3'
import {
  MenuIcon,
  XIcon,
    ShieldCheckIcon
} from '@heroicons/vue/outline'
import route from "ziggy";

const rawLinks = [
  {name: 'authorization code flow', href: route('authorizationCodeFlow') }
]

export default {
  name: "Header",
  components: {
      ShieldCheckIcon,
    Link,
    Popover,
    PopoverButton,
    PopoverPanel,
    MenuIcon,
    XIcon,
  },
  setup() {

    return {
      links: rawLinks,
      route
    }
  },
}
</script>
