<template>
  <TheMainApp />
</template>

<script>
import TheMainApp from './components/TheMainApp.vue'

export default {
  name: 'App',
  components: {
    TheMainApp,
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
::-webkit-scrollbar {
  width: 10px;
}
  
::-webkit-scrollbar-track {
   -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,1); 
   border-radius: 10px;
}
  
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px blue;
     background-color: rgba(18, 43, 63, 0.6); 
}
</style>
