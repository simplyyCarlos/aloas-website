
<template>
  <router-view :toast="toast"></router-view>
</template>

<script>
import { ref } from 'vue';
import Toast from 'primevue/toast';
export default {
  components: {
    Toast
  },
  setup() {
    const toast = ref(null);

    return {
      toast
    };
  }
};
</script>

<style>
  @font-face {
    font-family: defaultFont;
    src: url("assets/font/gontserrat/Gontserrat-Regular.ttf");
  }

 *{
  margin: 0;
  font-family: defaultFont;
  }
</style>
