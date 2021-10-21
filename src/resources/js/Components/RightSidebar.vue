<template>
  <div class="space-y-4">
    <Application />
    <User />
  </div>
</template>

<script>
import Application from "@/Components/RightSidebar/Application";
import User from "@/Components/RightSidebar/User";

export default {
    name: "RightSidebar",
  components: {Application, User},
}
</script>

<style scoped>

</style>
