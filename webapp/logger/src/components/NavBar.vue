<template>
    <nav class="navbar">
    <a class="navbar-brand" href="#">
      <div class="icon-container"> <img src="icons/gem.svg" /> </div> <span class="name">Agent Logger</span> 
    </a>
    <ul class="navbar-nav" >
       <li>
        <a  href="index.htm" :class="currentMenu.home"><img src="icons/house-fill.svg" /> Home</a>
      </li>
      <li>
        <a href="visitors_list.htm" :class="currentMenu.visites"> <img src="icons/journal-check.svg" /> Visites</a>
      </li>
      <li>
        <a href="attendance_agents.htm" :class="currentMenu.listes"><img src="icons/journal-check.svg" /> Listes</a>
      </li>
      <li>
        <a href="agent_profile.htm" :class="currentMenu.profile"><img src="icons/person-badge.svg" /> Profile</a>
      </li>
    </ul>
  </nav>
  <TheAuthorNote />
</template>

<script>
    import TheAuthorNote from './TheAuthorNote.vue'
    export default{
        name: 'NavBar',
        component:{
            TheAuthorNote
        },
        props: {
            currentMenu: Object         
        }
    }
</script>