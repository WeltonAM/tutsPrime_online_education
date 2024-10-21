<template>
    <footer class="py-3 my-4">
        <!-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item">
                <a href="#" class="nav-link px-2 text-muted">Term</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 text-muted">Privacy</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 text-muted">FAQs</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link px-2 text-muted">About</a>
            </li>
        </ul> -->
        
        <hr />

        <p class="text-center text-muted">&copy; {{ year }} Task Table</p>
        <p class="text-center text-muted">Developed by <a href="https://welton-matos-dev-portfolio.vercel.app/" target="_blank" class="text-muted">WeltonMatosDev</a></p>
    </footer>
</template>

<script scoped>
    export default {
        props: {
            year: {
                type: Number,
                default: new Date().getFullYear(),
            },
        },
    }
</script>
