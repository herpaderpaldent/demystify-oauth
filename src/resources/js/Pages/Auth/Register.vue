<template>
  <Head title="Register User" />
  <div class="p-8 max-w-7xl m-auto">
    <RegistrationForm />
  </div>
</template>

<script>

import RegistrationForm from "@/Components/Auth/RegistrationForm";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  name: "Register",
  components: {RegistrationForm, Head},
}
</script>
