<template>
  <NavBar currentMenu="menu"/>
</template>

<script>
import NavBar from './NavBar.vue'
export default {
  name: 'TheMainApp',
  data(){
    return{
      menu : {
        profile : "",
        listes : "",
        visites : "",
        home: "active"
      },
    }  
  },
  components:{
    NavBar
  }
}
</script>
