<template>
  <div>
    <header-component></header-component>
      
      <router-view></router-view>
      
  </div>
</template>

<script>
import Header from '@/components/elements/Header.vue'


export default {
  name: 'Dashboard',
  components: {
    'header-component': Header,
    
  },
  
}
</script>




