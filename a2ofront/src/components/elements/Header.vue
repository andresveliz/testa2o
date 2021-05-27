<template>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link to="/problem-1" class="nav-link">Problem One</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/problem-2" class="nav-link">Problem Two</router-link>
                </li>
            <li class="nav-item">
                <router-link to="/problem-3" class="nav-link">Problem Three</router-link>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    
</template>
<script>
export default {
    name:'Header',
    
}
</script>
<style scoped>
.menu {
    color: rgba(242, 241, 245, 0.815);
    text-decoration-line: none;
}
</style>