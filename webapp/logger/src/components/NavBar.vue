<template>
    <nav class="navbar">
    <a class="navbar-brand" href="#">
      <div class="icon-container"> <img src="icons/gem.svg" /> </div> <span class="name">Agent Logger</span> 
    </a>
    <ul class="navbar-nav" >
       <li>
        <a  href="index.htm" class="active"><img src="icons/house-fill.svg" /> Home</a>
      </li>
      <li>
        <a href="visitors_list.htm"> <img src="icons/journal-check.svg" /> Visites</a>
      </li>
      <li>
        <a href="attendance_agents.htm"><img src="icons/journal-check.svg" /> Listes</a>
      </li>
      <li>
        <a href="agent_profile.htm"><img src="icons/person-badge.svg" /> Profile</a>
      </li>
    </ul>

    <div class="navbar-footer">
      <div class="container">
        <h2>Software Packed by</h2> <span>Elvis Ansima</span> <a href="https://github.com/ElvisAns" target="_blank" >@ElvisAns</a> </div>
    </div>
  </nav>
</template>

<script>
    export default{
        name: 'NavBar',
        props: {
            currentMenu: String         
        }
    }
</script>