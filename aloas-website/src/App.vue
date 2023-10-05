
<template>
  <router-view></router-view>
  <Toast ref="toast" position="top-right" />
</template>

<script>
import { ref } from 'vue';
import { useToast } from 'primevue/usetoast';
export default {
  data() {
        return {
            toast: useToast(),
        };
    },
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
