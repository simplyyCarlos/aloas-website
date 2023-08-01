<script setup>
import CalendarComponent from '../components/CalendarComponent.vue';
import NavBar from '../components/NavBar.vue';
</script>

<template>
    <NavBar/>
   
    
    <main class="calendar">
        <CalendarComponent></CalendarComponent>
    </main>
</template>
<style scoped>
    .calendar {
        scale: 0.90;
        padding: 0;
        margin: 0;
    }



</style>
