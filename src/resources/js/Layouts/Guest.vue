<template>
  <div class="bg-white">
    <header>
      <Popover class="relative bg-white">
        <div class="flex justify-between items-center max-w-7xl mx-auto px-4 py-6 sm:px-6 md:justify-start md:space-x-10 lg:px-8">
          <div class="flex justify-start lg:w-0 lg:flex-1">
            <a href="#">
              <span class="sr-only">Workflow</span>
              <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-purple-600-to-indigo-600.svg" alt="" />
            </a>
          </div>
          <div class="-mr-2 -my-2 md:hidden">
            <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
              <span class="sr-only">Open menu</span>
              <MenuIcon class="h-6 w-6" aria-hidden="true" />
            </PopoverButton>
          </div>
          <nav class="hidden md:flex space-x-10">
            <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
              Pricing
            </a>
            <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
              Partners
            </a>
            <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
              Company
            </a>
          </nav>
          <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
            <inertia-link :href="route('login')" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
              Sign in
            </inertia-link>
            <inertia-link :href="route('register')" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
              Sign up
            </inertia-link>
          </div>
        </div>

        <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
          <PopoverPanel focus class="absolute z-30 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
              <div class="pt-5 pb-6 px-5">
                <div class="flex items-center justify-between">
                  <div>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-purple-600-to-indigo-600.svg" alt="Workflow" />
                  </div>
                  <div class="-mr-2">
                    <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                      <span class="sr-only">Close menu</span>
                      <XIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                  </div>
                </div>
              </div>
              <div class="py-6 px-5">
                <div class="grid grid-cols-2 gap-4">
                  <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700">
                    Application Registration
                  </a>
<!--                  <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700">
                    Partners
                  </a>
                  <a href="#" class="text-base font-medium text-gray-900 hover:text-gray-700">
                    Company
                  </a>-->
                </div>
                <div class="mt-6">
                  <inertia-link :href="route('register')" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700">
                    Sign up
                  </inertia-link>
                  <p class="mt-6 text-center text-base font-medium text-gray-500">
                    Existing customer?
                    <inertia-link :href="route('login')" class="text-gray-900">
                      Sign in
                    </inertia-link>
                  </p>
                </div>
              </div>
            </div>
          </PopoverPanel>
        </transition>
      </Popover>
    </header>

    <main>
      <slot>
        Main
      </slot>

    </main>

    <footer class="bg-gray-50" aria-labelledby="footerHeading">
      <h2 id="footerHeading" class="sr-only">Footer</h2>
      <div class="max-w-7xl mx-auto pt-16 pb-8 px-4 sm:px-6 lg:pt-24 lg:px-8">
        <div class="border-t border-gray-200 pt-8 md:flex md:items-center md:justify-between">
          <div class="flex space-x-6 md:order-2">
            <a v-for="item in social" :key="item.name" :href="item.href" class="text-gray-400 hover:text-gray-500">
              <span class="sr-only">{{ item.name }}</span>
              <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
            </a>
          </div>
          <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
            &copy; 2021 Workflow, Inc. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>

import {defineComponent, h} from "vue";

const social = [
    {
        name: 'GitHub',
        href: '#',
        icon: defineComponent({
            render: () =>
                h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                    h('path', {
                        'fill-rule': 'evenodd',
                        d:
                            'M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z',
                        'clip-rule': 'evenodd',
                    }),
                ]),
        }),
    }
]

    import {Popover, PopoverButton, PopoverPanel} from "@headlessui/vue";
    import {MenuIcon, XIcon} from "@heroicons/vue/outline/esm";

    export default {
        components: {
            Popover,
            PopoverButton,
            PopoverPanel,
            MenuIcon,
            XIcon
        },
        setup() {
            return {
                social
            }
        }
    }
</script>
