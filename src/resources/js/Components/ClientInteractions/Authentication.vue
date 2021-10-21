<template>
  <div>
    <div class="w-full ">
      <transition-group
        tag="div"
        :enter-active-class="requests.length > 1 ? 'transform ease-out delay-300 duration-300 transition': 'transform ease-out duration-300 transition'"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        move-class="transition ease-in-out duration-500"
      >
        <Request
          v-for="(request, index) in requests"
          :key="request.id"
          :ref="el => { if (el) element = el}"
          :request="request"
          :index="index"
          :class="[{'mt-4': index > 0 }]"
        />
      </transition-group>
    </div>
  </div>
</template>

<script>


import {computed, onMounted, ref, nextTick} from "vue";
import Request from "@/Components/ClientInteractions/Request";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
  name: "Authentication",
  components: {Request},
  emits: ['request-received'],
  setup(params, {emit}) {

    let client = computed(() => usePage().props.value.client)
    const requests = ref([])
    const element = ref('')

    onMounted(() => {
      Echo.channel(`client.${client.value.client_id}`)
        .listen('AuthorizationGranted', (e) => {
          requests.value.unshift(e);
          // emit the code, so the app knows to close the popup
          emit('request-received', _.get(e, 'redirect_data.code'))

          nextTick().then(() => element.value.$el.scrollIntoView({ left: 0, block: 'start', behavior: 'smooth' }) )

        });
    })

    return {
      requests,
      element
    }

  }
}
</script>

<style scoped>

</style>
