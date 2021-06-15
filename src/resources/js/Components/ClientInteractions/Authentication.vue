<template>
  <h3 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">Subscribed to {{client_id}}</h3>
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
                :key="request.id"
                :request = request
                :index="index"
                v-for="(request, index) in requests"
                :class="[{'mt-4': index > 0 }]"
        />
      </transition-group>
    </div>
  </div>
</template>

<script>


import {onMounted, ref} from "vue";
import Request from "@/Components/ClientInteractions/Request";

export default {
    name: "Authentication",
    components: {Request},
    props: {
        client_id: Number
    },
    setup(props) {

        const requests = ref([])

        onMounted(() => {
            Echo.channel(`client.${props.client_id}`)
                .listen('AuthorizationGranted', (e) => {
                    requests.value.unshift(e);
                });
        })

        return {
            requests
        }

    }
}
</script>

<style scoped>

</style>