<template>
  <ul>
    <li v-for="(request, key) in requests" :key="key">
      {{ request }}
    </li>
  </ul>
</template>

<script>


import {onMounted, ref} from "vue";

export default {
    name: "Authentication",
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