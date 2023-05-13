<template>
    <div class="container">
        <h1>Im from App.vue</h1>
        <seat></seat>
    </div>
</template>

<script>
    import Seat from './components/Seat.vue'
    export default {
        components: {
            Seat
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>